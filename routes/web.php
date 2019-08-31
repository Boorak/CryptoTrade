<?php


use BlockCypher\Core\BlockCypherCoinSymbolConstants;
use BlockCypher\Validation\TokenValidator;

Auth::routes();

/*
 |------------------------------------
 |            Page Routes
 |------------------------------------
 */

Route::get('/', 'PagesController@landing');
Route::get('/trading', 'PagesController@trading');
Route::get('/home', 'PagesController@home');


Route::get('/verifyEmail/{token}', 'Auth\RegisterController@verify');


Route::get('/create-wallet', function () {

    $hd = new \App\Cypher\HDWallet();
    $res = $hd->deleteWalletEndpoint();
    return $res;

});


