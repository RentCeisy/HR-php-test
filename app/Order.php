<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';

    public function partner() {
        return $this->hasOne('App\Partner', 'id', 'partner_id');
    }

    public function orderProduct() {
        return $this->hasMany('App\OrderProduct', 'order_id', 'id');
    }

    public function product() {
        return $this->belongsToMany('App\Product', 'order_products', 'order_id', 'product_id');
    }

    public function scopeGetCostOrder() {
        return $this->orderProduct()->sum(DB::raw('quantity*price'));
    }

}
