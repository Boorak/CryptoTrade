<?php

namespace App\Http\Controllers\Api\V1;

use App\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function userBalance()
    {
        $balance = Balance::where('user_id', '=', auth()->user()->id)->get();
        return response()->json($balance, 200);
    }
}
