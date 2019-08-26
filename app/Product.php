<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
    Get the vendor record associated with the product 
    */
    public function vendor()
    {
        return $this->belongsTo('\App\Vendor');
    }
    
    /**
    * Get product orders records associated with the product
    */
    public function order()
    {
        return $this->hasMany('\App\OrderProduct');
    } 
}
