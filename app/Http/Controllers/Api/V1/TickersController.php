<?php

namespace App\Http\Controllers\Api\V1;

use App\Ac;
use App\Asset;
use App\Pair;
use App\Ticker;
use App\Http\Controllers\Controller;

class TickersController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDefaultTicker()
    {
        $ticker = $this->getTicker(1);
        return response()->json($ticker, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTickers()
    {
        $tickers = $this->getPairs();
        return response()->json($tickers, 200);
    }

    /**
     * @return array
     */
    private function getPairs()
    {
        $assets = Ac::where('is_asset', true)->get();
        $assetArr = [];
        foreach ($assets as $asset) {
            $assetArr[] = $this->assetSerializer($asset);
        }
        return $assetArr;
    }

    /**
     * @param $currency
     * @param $ticker
     * @return array
     */
    private function serializerFormat($currency, $ticker)
    {
        if ($ticker) {

            $data = [
                'id' => $currency->id,
                'symbol' => $currency->symbol,
                'price' => $ticker->price,
                'percent_change' => $ticker->percent_change,
                'percent_color' => $ticker->percent_color,
                'min' => $ticker->min,
                'max' => $ticker->max,
                'volume' => $ticker->volume,
            ];

        } else {

            $data = [
                'id' => $currency->id,
                'symbol' => $currency->symbol,
                'price' => 0,
                'percent_change' => 0,
                'percent_color' => '',
                'min' => 0,
                'max' => 0,
                'volume' => 0,
            ];
        }

        return $data;

    }

    /**
     * @param $asset
     * @return array
     */
    private function assetSerializer($asset)
    {
        return [
            'id' => $asset->id,
            'symbol' => $asset->symbol,
            'currencies' => $this->currencySerializer($asset->id),
        ];
    }

    /**
     * @param $assetId
     * @return array
     */
    private function currencySerializer($assetId)
    {
        $currenciesCollection = [];
        $pairs = Pair::where('asset_id', '=', $assetId)->get();
        foreach ($pairs as $pair) {
            $currency = Ac::find($pair->currency_id);
            $ticker = $this->getTicker($pair->id);
            $currenciesCollection[] = $this->serializerFormat($currency, $ticker);
        }
        return $currenciesCollection;
    }

    /**
     * @param $pairId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    private function getTicker($pairId)
    {
        return Ticker::where('pair_id', $pairId)->first();
    }

}
