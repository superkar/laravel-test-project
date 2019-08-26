<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
    * Order statuses explanations
    *
    * @var array
    */
    private static $statuses = [
            '0'     => 'новый',
            '10'    => 'подтвержден',
            '20'    => 'завершен',
        ];
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_email', 'partner_id', 'status'];
    
    /**
    * Get the partner record associated with the order
    */        
    public function partner()
    {
        return $this->belongsTo('\App\Partner');
    }
    
    /**
    * Get products records associated with the order
    */   
    public function products()
    {
        return $this->hasMany('\App\OrderProduct');
    }
    
    /**
    * Get the name of the order status
    */
    public function status()
    {
        return self::$statuses[$this->status];
    }
    
    /**
    * Calculate the order price
    */
    public function getPrice()
    {
        $price = 0;
        foreach($this->products as $item) $price += $item->price * $item->quantity;
        return $price;
    }
    
    /**
    * Get the list of possible order satuses
    */
    public static function getStatuses()
    {
        return self::$statuses;
    }
}
