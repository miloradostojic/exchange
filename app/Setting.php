<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are not mass assignable.
     */
    protected $guarded = ['id'];
    
}
