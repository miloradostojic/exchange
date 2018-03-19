<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Order;
use App\Currency;
use App\Setting;
use App\Mail\Order as MailOrder;

class ExchangeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // all currencies
        $currencies = Currency::all();
        
        return view('exchange')->with('currencies', $currencies);
            
    }
    
    /**
     * Calculate selected foreign currency,
     * 
     * @param  Illuminate\Http\Request  $request
     * @return json $response
     */
    public function calculate(Request $request)
    {
        $data = $request->all();
        // selected currency
        $currency = Currency::where('id', $data['currency'])->first();
        // callculations for new order
        $results = $currency->calculate_order($data['amount']);
        
        $response = array( 
            'to_pay' => $results['to_pay'],
            'total_to_pay' => $results['total_to_pay'],
            'discount_percent' => $currency->discount_percent,
            'surcharge_percent' => $currency->surcharge_percent,
        );
        return Response::json($response);
    }
    
    /**
     * Handle currency purchase, store a newly created order in storage
     * 
     * @param  Illuminate\Http\Request  $request
     * @return response
     */
    public function purchase(Request $request)
    {
        $data = $request->all();
        // current settings
        $settings = Setting::find(1);
        // selected currency
        $currency = Currency::where('id', $data['currency'])->first(); 
        // callculations for new order
        $results = $currency->calculate_order($data['amount']); 
        
        //Saving new order
        $order = Order::create(['currency_id' => $data['currency'],
                        'currency_amount' => $data['amount'], 
                        'exchange_rate' => $currency->exchange_rate, 
                        'surcharge_percent' => $currency->surcharge_percent, 
                        'surcharge_amount' => $results['surcharge_amount'], 
                        'paid_amount_usd' => $results['total_to_pay'], 
                        'discount_percent' => $currency->discount_percent, 
                        'discount_amount' => $results['discount_amount'] 
                    ]);
        
        // if currency is EURO send mail with order details
        if ($currency->id == 2){ 
            \Mail::to($settings->email)->send(new MailOrder($order));
        }
        return Response::json();
    }
}
