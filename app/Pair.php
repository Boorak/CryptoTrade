<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Ac::class, 'asset_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Ac::class, 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderSells()
    {
        return $this->hasMany(OrderSell::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderBuys()
    {
        return $this->hasMany(OrderBuy::class);
    }

}
