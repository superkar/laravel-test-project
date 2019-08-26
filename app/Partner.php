<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /**
    * Get orders records associated with the partner
    */
    public function orders()
    {
        return $this->hasMany('\App\Order');
    }
}
