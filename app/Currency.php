<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Currency extends Model
{
    /**
     * The attributes that are not mass assignable.
     */
    protected $guarded = ['id'];
    
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    
    /**
     * Function for calculation new orders
     * @param int $amount
     * @return $results array of order details
     */
    public function calculate_order($amount)
    {
        $to_pay = $amount / $this->exchange_rate;
        $surcharge_amount = ($this->surcharge_percent / 100) * $to_pay;
        $to_pay_wo_discount = $to_pay + $surcharge_amount;
        $discount_amount = ($this->discount_percent / 100) * $to_pay_wo_discount;
        $total_to_pay = $to_pay + $surcharge_amount - $discount_amount;        
        $results = array('to_pay' => $to_pay, 
                            'surcharge_amount' => $surcharge_amount,
                            'discount_amount' => $discount_amount,
                            'total_to_pay' => $total_to_pay, );
        
        return $results;
    }
}
