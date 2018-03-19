<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Setting;
use App\Currency;
//enables to output flash messaging
use Session;

class SettingController extends Controller
{
    /**
    * Display a listing of the resources
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // this specific settings record
        $settings = Setting::find(1);
        // all currencies
        $currencies = Currency::all();
        
        return view('setting')->with('currencies', $currencies)
                              ->with('settings', $settings);
    }
    
    /**
    * Update the specified resources in storage
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function edit(Request $request)
    {
        $settings = Setting::find(1);
        //Validate  email 
        $this->validate($request, [
            'email'=>'required|email',
        ]);
        //retreive email
        $email = $request->only(['email']); 
        //retreive all currencies
        $currencies = $request['currencies']; 
        // save change to settings
        $settings->fill($email)->save();
        
        //save percent value for every currency
        foreach ($currencies as $key => $value){ 
            $currency = Currency::find($key);
            $currency->discount_percent = $value;
            $currency->save();
        }
        
        return back()->with('message',"Changes are saved!");;
    }
    
}
