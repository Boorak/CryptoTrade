<?php

namespace App\Cypher;

use Zttp\Zttp;

class HDWallet extends BaseController
{
    /**
     * @return mixed
     */
    public function getWalletEndpoint()
    {
        $response = Zttp::get($this->uri('wallets/hd/' . config('podonak.wallet.name')));
        return $response->json();
    }

    /**
     * @return mixed
     */
    public function createWalletEndpoint()
    {
        $response = Zttp::post($this->uri('wallets/hd'), [
            "name" => config('podonak.wallet.name'),
            "extended_public_key" => config('podonak.wallet.extended_public_key'),
        ]);
        return $response->json();
    }

    /**
     * @return mixed
     */
    public function getWalletAddressesEndpoint()
    {
        $response = Zttp::get($this->uri('wallets/hd/' . config('podonak.wallet.name') . '/addresses'));
        return $response->json();
    }

    public function deleteWalletEndpoint()
    {
        $response = Zttp::delete('wallets/hd/' . config('podonak.wallet.name'));
        return $response->json();
    }

}