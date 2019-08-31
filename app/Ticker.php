<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pair()
    {
        return $this->belongsTo(Pair::class);
    }


}
