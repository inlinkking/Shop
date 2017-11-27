<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'order_address';
}
