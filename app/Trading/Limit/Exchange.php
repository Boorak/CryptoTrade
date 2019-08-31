<?php

namespace App\Trading\Limit;

use App\Asset;
use App\Balance;
use App\Candle;
use App\Currency;
use App\OrderSell;
use App\OrderBuy;
use App\Pair;
use App\Ticker;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Exchange
{
    const STATUS_CONFIRMED = "confirmed";
    const STATUS_PARTIAL = "partial";

    /**
     * @var Balance
     */
    protected $balance;

    /**
     * @var OrderSell
     */
    protected $orderSell;

    /**
     * @var OrderBuy
     */
    protected $orderBuy;

    /**
     * Exchange constructor.
     * @param Balance $balance {
     * @param OrderSell $orderSell
     * @param OrderBuy $orderBuy
     */
    public function __construct(Balance $balance, OrderSell $orderSell, OrderBuy $orderBuy)
    {
        $this->balance = $balance;
        $this->orderSell = $orderSell;
        $this->orderBuy = $orderBuy;
    }

    /**
     * @param $order
     * @param $amount
     */
    protected function updateOrderFill($order, $amount)
    {
        $order->updateFill($order->fill + $amount);
        if ($order->fill == $order->amount) {
            $order->updateStatus(Exchange::STATUS_CONFIRMED);
        } else {
            $order->updateStatus(Exchange::STATUS_PARTIAL);
        }

    }

    /**
     * @param $order
     * @return bool
     */
    protected function isFill($order)
    {
        return $order->amount == $order->fill;
    }

    /**
     * @param $order
     * @param $orderBook
     * @param $amount
     * @param $price
     * @param $type
     * @param $pairId
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function saveTransaction($order, $orderBook, $amount, $price, $type, $pairId)
    {
        return Transaction::create([
            'seller_id' => $orderBook->user_id,
            'buyer_id' => $order->user_id,
            'order_sale_id' => $orderBook->id,
            'order_buy_id' => $order->id,
            'pair_id' => $pairId,
            'amount' => $amount,
            'price' => $price,
            'type' => $type,
            'timestamp' => ($t = $this->getMicroTime()),
        ]);
    }

    /**
     * @param $aId
     * @param $cId
     * @return mixed
     */
    protected function getPairId($aId, $cId)
    {
        $pairId = Pair::where('asset_id', $aId)
            ->where('currency_id', $cId)->first()->id;

        return $pairId;
    }

    /**
     * @param $aId
     * @param $cId
     * @param Transaction $transaction
     */
    protected function processCandles($aId, $cId, Transaction $transaction)
    {
        $this->processCandle(1, $aId, $cId, $transaction);
        $this->processCandle(5, $aId, $cId, $transaction);
        $this->processCandle(15, $aId, $cId, $transaction);
        $this->processCandle(30, $aId, $cId, $transaction);
        $this->processCandle(60, $aId, $cId, $transaction);
        $this->processCandle(60 * 4, $aId, $cId, $transaction);
        $this->processCandle(60 * 12, $aId, $cId, $transaction);
        $this->processCandle(60 * 24, $aId, $cId, $transaction);
        $this->processCandle(60 * 24 * 3, $aId, $cId, $transaction);
        $this->processCandle(60 * 24 * 7, $aId, $cId, $transaction);
    }

    /**
     * @param int $timeframe Minutes
     * @param $aId
     * @param $cId
     * @param Transaction $transaction
     */
    protected function processCandle($timeframe, $aId, $cId, Transaction $transaction)
    {
        $timestamp = (int)($transaction->timestamp / (60000 * ($timeframe)));

        $candle = Candle::whereT($timestamp)->first();

        if ($candle) {

            DB::update("UPDATE candles SET c=$transaction->price, h=GREATEST(h, $transaction->price), l=LEAST(l, $transaction->price), count=count+1, v=v+$transaction->amount WHERE t=$timestamp");

        } else {

            Candle::create([
                'pair_id' => $this->getPairId($aId, $cId),
                'time_frame' => $timeframe,
                'o' => $transaction->price,
                'c' => $transaction->price,
                'h' => $transaction->price,
                'l' => $transaction->price,
                'v' => $transaction->amount,
                't' => $timestamp,
                'count' => $transaction->amount,
            ]);

        }
    }

    /**
     * @param $aId
     * @param $cId
     * @param Transaction $transaction
     * @return $this|\Illuminate\Database\Eloquent\Model|null|static
     */
    protected function processTicker($aId, $cId, Transaction $transaction)
    {

        $pairId = $this->getPairId($aId, $cId);
        $ticker = Ticker::where('pair_id', $pairId)->first();

        if ($ticker) {

            $percentChange = $this->calculatePercentChange($oldPrice = $ticker->price, $pairId);

            $ticker->update([
                'price' => $transaction->price,
                'max' => $this->get24Hr($pairId)->max('price'),
                'min' => $this->get24Hr($pairId)->min('price'),
                'volume' => $ticker->volume + $transaction->amount,
                'percent_change' => $percentChange['change'],
                'percent_color' => $percentChange['color'],
            ]);

        } else {

            return Ticker::create([
                'pair_id' => $pairId,
                'price' => $transaction->price,
                'max' => $this->get24Hr($pairId)->max('price'),
                'min' => $this->get24Hr($pairId)->min('price'),
                'volume' => $transaction->amount,
                'percent_change' => 0,
                'percent_color' => 'green',
            ]);

        }

        return $ticker;

    }

    /**
     * @return float|int
     */
    private function getMicroTime()
    {
        return microtime(true) * 1000;
    }

    /**
     * @param $oldPrice
     * @param $pairId
     * @return array
     */
    private function calculatePercentChange($oldPrice, $pairId)
    {

        $newPrice = Transaction::where('created_at', '>=', Carbon::now()->subDay())
            ->where('pair_id', $pairId)
            ->orderBy('created_at', 'desc')
            ->first()->price;
        $diff = $newPrice - $oldPrice;
        $percentChange = ($diff / $oldPrice) * 100;
        $percentColor = $diff > 0 ? "#7a9c4a" : "#aa6064";
        return [
            "change" => abs($percentChange),
            "color" => $percentColor,
        ];
    }

    /**
     * @param $pairId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function get24Hr($pairId)
    {
        return Transaction::where('created_at', '>=', Carbon::now()->subDay())
            ->where('pair_id', $pairId)
            ->get();
    }

}