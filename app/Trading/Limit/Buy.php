<?php

namespace App\Trading\Limit;

use App\Events\OrderBookConfirm;
use App\Events\OrderConfirm;
use App\Events\Ticker;
use Illuminate\Support\Facades\DB;

class Buy extends Exchange
{
    /**
     * @param $order
     */
    public function process($order)
    {
        foreach ($this->orderSell->orderBook($order) as $orderBook) {

            if ($this->isFill($order)) {
                break;
            }

            $price = $orderBook->price;
            $amount = min($order->remainAmount(), $orderBook->remainAmount());
            $totalPrice = $amount * $price;
            $cId = $order->pair->currency_id;
            $aId = $order->pair->asset_id;

            //Buyer Balance Calculation
            DB::table('balances')->where('user_id', $order->user_id)->where('ac_id', $cId)->decrement('amount', $totalPrice);
            DB::table('balances')->where('user_id', $order->user_id)->where('ac_id', $aId)->increment('amount', $amount);
            DB::table('balances')->where('user_id', $order->user_id)->where('ac_id', $aId)->increment('available', $amount);

            //Seller Balance Calculation
            DB::table('balances')->where('user_id', $orderBook->user_id)->where('ac_id', $cId)->increment('amount', $totalPrice);
            DB::table('balances')->where('user_id', $orderBook->user_id)->where('ac_id', $cId)->increment('available', $totalPrice);
            DB::table('balances')->where('user_id', $orderBook->user_id)->where('ac_id', $aId)->decrement('amount', $amount);

            $remainAmount = $amount * ($order->price - $price);

            if ($remainAmount != 0) {

                DB::table('balances')->where('user_id', $order->user_id)->where('ac_id', $cId)->increment('available', $remainAmount);
            }

            $transaction = $this->saveTransaction($order, $orderBook, $amount, $price, 'buy', $this->getPairId($aId, $cId));
            $this->updateOrderFill($orderBook, $amount);
            $this->updateOrderFill($order, $amount);

            $this->processCandles($aId, $cId, $transaction);
            $ticker = $this->processTicker($aId, $cId, $transaction);

            OrderConfirm::dispatch($order, $price);
            OrderConfirm::dispatch($orderBook, $price);
            OrderBookConfirm::dispatch();
            Ticker::dispatch($ticker);
        }
    }
}