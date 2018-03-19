<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currency name Change Successfully';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // set API Endpoint and access key (and any options of your choice)
        $endpoint = 'live';
        $access_key = '7bdfb189f6e0c580fdeb6e5c238d6dce';
        $currencies = 'JPY,GBP,EUR';
        $source = 'USD';
        $format = '1';

        // Initialize CURL
        $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies= '.$currencies.'&source='.$source.'&format ='.$format.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response
        $exchangeRates = json_decode($json, true);
        
        // If response is success update exchange rate for each currency
        if ($exchangeRates['success']){
            foreach($exchangeRates['quotes'] as $key => $value){
                $currency_short_name = substr($key, 3);
                \DB::table('currencies')
                ->where('short_name', $currency_short_name)
                ->update(['exchange_rate' => $value]);
            }
            $this->info('Exchange rates are updated!');
        }else{
            $this->info($exchangeRates['error']['info']);
        }
    }
}
