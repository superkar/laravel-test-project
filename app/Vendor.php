<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
    * Get product records associated with the vendor
    */
    public function products()
    {
        return $this->hasMany('\App\Product');
    }
}
