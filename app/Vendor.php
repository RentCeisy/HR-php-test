<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    public function product() {
        return $this->hasMany('App\Product', 'vendor_id', 'id');
    }
}
