<?php

namespace App\Http\Controllers\Api\V1;

use BlockCypher\Client\HDWalletClient;
use App\Http\Controllers\Controller;
use BlockCypher\Core\BlockCypherCoinSymbolConstants;
use BlockCypher\Validation\TokenValidator;

class DepositController extends Controller
{

    public function index()
    {
        $walletName = 'podonak';
        $walletClient = new HDWalletClient('BCY.test');
    }

    private function validateToken()
    {
        return TokenValidator::validate($token);
    }

    private function createApiContextForAllChains($token)
    {
        $version = 'v1';

        $chainNames = BlockCypherCoinSymbolConstants::CHAIN_NAMES();

        $apiContexts = array();
        foreach ($chainNames as $chainName) {

            list($coin, $chain) = explode(".", $chainName);
            $coin = strtolower($coin);

            $apiContexts[$chainName] = getApiContextUsingConfigArray($token, $chain, $coin, $version);
        }

        return $apiContexts;
    }


}
