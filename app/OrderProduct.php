<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /**
    * Get the order record associated with the order product
    */
    public function order()
    {
        return $this->belongsTo('\App\Order');
    }
    
    /**
    * Get the product details record associated with the order product
    */
    public function product()
    {
        return $this->belongsTo('\App\Product');
    }
    
}
