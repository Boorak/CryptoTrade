<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    protected $guarded = [];

    protected $with = ['ac'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ac()
    {
        return $this->belongsTo(Ac::class);
    }

    /**
     * @param $currency
     * @return Model|null|static
     */
    public function getUserBalance($currency)
    {
        return $this
            ->where('user_id', '=', auth()->user()->id)
            ->where('ac_id', '=', $currency)
            ->first();
    }

}
