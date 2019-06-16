<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public function order() {
        return $this->belongsTo('App\Order', 'id', 'order_id');
    }

    public function product() {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function scopeGetSelect($query){
        return $query->select(['id', 'order_id', 'product_id', 'price', 'quantity', DB::raw('(quantity*price) as cost')]);
    }


}
