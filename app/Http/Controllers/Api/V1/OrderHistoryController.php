<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use App\Http\Controllers\Controller;

class OrderHistoryController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function orders()
    {
        $user = auth()->user();
        $buyOrders = $user->orderBuy()->latest()->get();
        $sellOrders = $user->orderSell()->latest()->get();
        $orders = array_merge($buyOrders->toArray(), $sellOrders->toArray());
        return response()->json($orders, 200);
    }
}
