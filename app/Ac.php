<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ac extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets()
    {
        return $this->hasMany(Pair::class, 'asset_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function currencies()
    {
        return $this->hasMany(Pair::class, 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(Balance::class);
    }
}
    