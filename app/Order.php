<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are not mass assignable.
     */
    protected $guarded = ['id'];
    
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
