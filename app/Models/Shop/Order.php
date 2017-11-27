<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function express()
    {
        return $this->belongsTo('App\Models\Shop\Express');
    }

    public function order_products()
    {
        return $this->hasMany('App\Models\Shop\OrderProduct');
    }

    public function address()
    {
        return $this->hasOne('App\Models\Shop\OrderAddress');
    }
}
