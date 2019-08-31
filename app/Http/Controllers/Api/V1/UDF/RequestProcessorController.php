<?php

namespace App\Http\Controllers\Api\V1\UDF;

use App\Candle;
use App\Pair;
use App\SoCandle;
use App\TvSymbol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

class RequestProcessorController extends Controller
{

    /**
     * @return array
     */
    public function sendConfig()
    {
        return [
            "supports_search" => true,
            "supports_group_request" => false,
            "supports_marks" => false,
            "supports_timescale_marks" => true,
            "supports_time" => true,
            "exchanges" => [
                [
                    "value" => "",
                    "name" => "All Exchanges",
                    "desc" => "",
                ],
//                [
//                    "value" => "XETRA",
//                    "name" => "XETRA",
//                    "desc" => "XETRA",
//                ],
//                [
//                    "value" => "NSE",
//                    "name" => "NSE",
//                    "desc" => "NSE",
//                ],
            ],
            "symbolsTypes" => [
                [
                    "name" => "All types",
                    "value" => "",
                ],
                [
                    "name" => "Stock",
                    "value" => "stock",
                ],
                [
                    "name" => "Index",
                    "value" => "index",
                ],
            ],
            "supported_resolutions" => ["1", "5", "15", "30", "60", "D", "3D", "1W"],
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function sendSendSymbolInfo(Request $request)
    {
        $input = $request->only('symbol');

        return [
            "name" => $input['symbol'], //Name of symbol
            "exchange-traded" => "XETRA", //Short name of exchange
            "exchange-listed" => "XETRA", //Short name of exchange
            "timezone" => "Asia/Tehran", //Exchange timezone
            "minmov" => 1, //These three keys have different meaning when using for common prices and for fractional prices.
            "minmov2" => 0, //These three keys have different meaning when using for common prices and for fractional prices.
            "pointvalue" => 1,
            "session" => "0930-1630", //Trading hours for this symbol
            "has_intraday" => true,
            "has_no_volume" => false,
            "description" => "Bitcoin Exchange", //Description of a symbol
            "type" => "stock", //Optional type of the instrument.
            "supported_resolutions" => ["1", "5", "15", "30", "60", "D", "3D", "1W"],
            "pricescale" => 100,
            "ticker" => $input['symbol'], //It's an unique identifier for this symbol in your symbology,
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function sendSymbolSearchResult(Request $request)
    {
        $inputs = $request->only(['query', 'type', 'exchange', 'limit']);
        $symbols = DB::table('tv_symbols');

        if (isset($inputs['query'])) {
            $symbols = $symbols->where('symbol', $inputs['query']);
        } elseif (isset($inputs['type'])) {
            $symbols = $symbols->where('type', $inputs['type']);
        } elseif (isset($inputs['exchange'])) {
            $symbols = $symbols->where('exchange', $inputs['exchange']);
        } elseif (isset($inputs['limit'])) {
            $symbols = $symbols->take($inputs['limit']);
        }

        return $symbols->get();

    }

    /**
     * @param Request $request
     * @return array
     */
    public function sendSymbolHistory(Request $request)
    {
        $inputs = $request->only(['symbol', 'from', 'to', 'resolution']);

        $histories = $this->getHistories($inputs['symbol'], $inputs['resolution'], $inputs['from'], $inputs['to']);
        return $this->convertHistoryDataToUDFFormat($histories);
    }

    /**
     * @return int
     */
    public function sendTime()
    {
        return time();
    }

    /**
     * @return mixed
     */
    private function getHistories($symbol, $resolution, $from, $to)
    {

        $r = "";

        switch (strtolower($resolution)) {
            case "d":
            case "1d":
                $r = 24 * 60;
                break;
            case "3d":
                $r = 24 * 60 * 3;
                break;
            case "1w":
                $r = 24 * 60 * 7;
                break;
            case 1:
            case 5:
            case 15:
            case 30:
            case 60:
                $r = $resolution;
                break;
        }


        $from = $from / (60 * $r);
        $to = $to / (60 * $r);

        $pairId = Pair::where('pair', '=', $symbol)->first()->id;

        return SoCandle::where('pair_id', $pairId)->where('time_frame', $r)->whereBetween('t', [$from, $to])->get();



    }

    /**
     * @param $histories
     * @return array
     */
    private function convertHistoryDataToUDFFormat($histories): array
    {
        $t = [];
        $o = [];
        $c = [];
        $l = [];
        $h = [];
        $v = [];
        $counts = [];


        foreach ($histories as $history) {
            $t[] = $history->t * 60;
            $o[] = $history->o;
            $c[] = $history->c;
            $l[] = $history->l;
            $h[] = $history->h;
            $v[] = $history->v;
            $counts[] = $history->count;
        }

        if (count($histories) > 0) {
            $s = "ok";
        } else {
            $s = "no_data";
        }


        return [
            "t" => $t,
            "o" => $o,
            "c" => $c,
            "l" => $l,
            "h" => $h,
            "v" => $v,
            "s" => $s,
            "count" => $counts
        ];
    }
}
