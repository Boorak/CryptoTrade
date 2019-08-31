<?php

namespace App\Http\Controllers\Api\V1;

use App\OrderBuy;
use App\OrderSell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderBookController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function sellOrderBook()
    {

        $orders = OrderSell::where('status', '=', 'in_progress')
            ->orWhere('status', '=', 'partial')
            ->orderBy('price', 'desc')
            ->get();

        return response()->json($orders, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function buyOrderBook()
    {
        $orders = OrderBuy::where('status', '=', 'in_progress')
            ->orWhere('status', '=', 'partial')
            ->orderBy('price', 'asc')
            ->get();

        return response()->json($orders, 200);
    }
}
