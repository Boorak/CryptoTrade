<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBuy extends Model
{
    protected $guarded = [];

    protected $with = ['pair'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pair()
    {
        return $this->belongsTo(Pair::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @param $status
     */
    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
    }

    /**
     * @param $amount
     */
    public function updateFill($amount)
    {
        $this->update(['fill' => $amount]);
    }

    /**
     * @return mixed
     */
    public function remainAmount()
    {
        return ($this->amount - $this->fill);
    }

    /**
     * @param $order
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function orderBook($order)
    {
        return $this
            ->whereRaw('fill < amount')
            ->where('pair_id', '=', $order->pair_id)
            ->where('price', '>=', $order->price)
            ->orderBy('price', 'desc')
            ->get();
    }

    /**
     * @return $this|Model
     */
    public static function storeOrder()
    {
        return self::create([
            'user_id' => auth()->id(),
            'pair_id' => self::getPairId(request('asset_id'), request('currency_id')),
            'price' => \request('price'),
            'amount' => \request('amount'),
        ]);

    }

    /**
     * @return mixed
     */
    public function getRemainAmountAttribute()
    {
        return ($this->amount - $this->fill);
    }

    /**
     * @param $aId
     * @param $cId
     * @return mixed
     */
    private static function getPairId($aId, $cId)
    {
        $pairId = \App\Pair::where('asset_id', $aId)
            ->where('currency_id', $cId)->first()->id;

        return $pairId;
    }

}
