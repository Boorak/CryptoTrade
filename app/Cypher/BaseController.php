<?php

namespace App\Cypher;

use Zttp\Zttp;

class BaseController
{
    protected function uri($query)
    {
        return "api.blockcypher.com/v1/bcy/test/{$query}?token=" . config('podonak.cypher.token');
    }

}