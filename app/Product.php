<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function vendor() {
        return $this->hasOne('App\Vendor', 'id', 'vendor_id');
    }
}
