<?php

use Illuminate\Http\Request;


Route::prefix('v1')->group(function () {

    /*
     |------------------------------------
     |              OrderBuy
     |------------------------------------
     */
    Route::post('/trade/orderbuy', 'Api\V1\OrderBuyController@store');
    Route::patch('/trade/orderbuy/{id}/update', 'Api\V1\OrderBuyController@update');
    Route::delete('/trade/orderbuy/{id}/delete', 'Api\V1\OrderBuyController@destroy');

    /*
     |------------------------------------
     |              OrderSell
     |------------------------------------
     */
    Route::post('/trade/ordersell', 'Api\V1\OrderSellController@store');
    Route::patch('/trade/ordersell/{id}/update', 'Api\V1\OrderSellController@update');
    Route::delete('/trade/ordersell/{id}/delete', 'Api\V1\OrderSellController@destroy');

    /*
     |------------------------------------
     | OrderBook & Balance & OrderHistory
     |------------------------------------
     */
    Route::get('/trade/user/orders/history', 'Api\V1\OrderHistoryController@orders');
    Route::get('/trade/user/balance', 'Api\V1\BalanceController@userBalance');
    Route::get('/trade/orderbook/buy', 'Api\V1\OrderBookController@buyOrderBook');
    Route::get('/trade/orderbook/sell', 'Api\V1\OrderBookController@sellOrderBook');

    /*
    |------------------------------------
    |               Tickers
    |------------------------------------
    */
    Route::get('/trading/tickers', 'Api\V1\TickersController@getTickers');
    Route::get('/trading/default/ticker', 'Api\V1\TickersController@getDefaultTicker');

    /*
     |------------------------------------
     |                UDF
     |------------------------------------
     */
    Route::get('udf/config', 'Api\V1\UDF\RequestProcessorController@sendConfig');
    Route::get('udf/symbols', 'Api\V1\UDF\RequestProcessorController@sendSendSymbolInfo');
    Route::get('udf/search', 'Api\V1\UDF\RequestProcessorController@sendSymbolSearchResult');
    Route::get('udf/history', 'Api\V1\UDF\RequestProcessorController@sendSymbolHistory');
    Route::get('udf/time', 'Api\V1\UDF\RequestProcessorController@sendTime');
});
