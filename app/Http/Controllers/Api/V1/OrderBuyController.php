<?php

namespace App\Http\Controllers\Api\V1;

use App\Balance;
use App\Events\OrderBook;
use App\Http\Requests\StoreOrderBuy;
use App\OrderBuy;
use App\Trading\Limit\Buy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderBuyController extends Controller
{

    /**
     * @var Balance
     */
    protected $balance;

    /**
     * OrderBuyController constructor.
     * @param Balance $balance
     */
    public function __construct(Balance $balance)
    {
        $this->middleware('auth:api');
        $this->balance = $balance;
    }

    /**
     * @param Request $request
     * @param Buy $exchanger
     * @param StoreOrderBuy $validation
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Buy $exchanger, StoreOrderBuy $validation)
    {
        $cId = $request->currency_id;
        if ($this->isValidOrder($cId)) {
            $this->decrementUserBalance($cId, $this->totalPrice($request));
            $order = OrderBuy::storeOrder();
            $validOrder = OrderBuy::find($order->id);
            $exchanger->process($validOrder);
            OrderBook::dispatch($validOrder);
            return response()->json([], Response::HTTP_OK);
        }

        return \response()->json([], 403);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $orderBuy = OrderBuy::find($id);
        $orderBuy->update([
            'price' => \request('price'),
            'amount' => \request('amount'),
        ]);

        return response()->json($orderBuy, 201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $order = OrderBuy::find($id);
        $cId = $order->pair->currency_id;
        $amount = $order->remainAmount() * $order->price;
        $this->incrementUserBalance($cId, $amount);
        $order->delete();
        return response()->json([], 204);
    }

    /**
     * @return float|int
     */
    private function totalPrice()
    {
        return (\request()->amount * \request()->price);
    }

    /**
     * @param $currency
     * @return bool
     */
    private function isValidOrder($currency): bool
    {
        $balance = $this->balance->getUserBalance($currency);
        return $this->totalPrice() < $balance->available && $this->totalPrice() != 0;
    }

    /**
     * @param $currencyId
     * @param $amount
     */
    private function decrementUserBalance($currencyId, $amount): void
    {
        DB::table('balances')
            ->where('user_id', auth()->user()->id)
            ->where('ac_id', $currencyId)
            ->decrement('available', $amount);
    }

    /**
     * @param $currencyId
     * @param $amount
     */
    private function incrementUserBalance($currencyId, $amount): void
    {
        DB::table('balances')
            ->where('user_id', auth()->user()->id)
            ->where('ac_id', $currencyId)
            ->increment('available', $amount);
    }

}
