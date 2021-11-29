<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Master_kursx;

class getKurs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxa:getForeignRate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'foreign exhange rates from external resource api';

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
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/inr/idr.json');
        $response = json_decode($request->getBody()->getContents());

        //return (['data' => json_decode($response) ]);
        $cek = Master_kursx::where('currency', '=', 'INR')->first();
        if (isset($cek)) {

                $master_kurs = new Master_kursx;

                $master_kurs = Master_kursx::find('INR');
                $master_kurs->currency = 'INR';
                $master_kurs->value = 1.00;
                $master_kurs->selling_rate = $response->idr;
                $master_kurs->buying_rate = 0;
                $master_kurs->last_update = $response->date;

                $master_kurs->save();


        }else{

                $master_kurs = new Master_kursx;

                $master_kurs->currency = 'INR';
                $master_kurs->value = 1.00;
                $master_kurs->selling_rate = $response->idr;
                $master_kurs->buying_rate = 0;
                $master_kurs->last_update = $response->date;

                $master_kurs->save();

        }
        $this->info('command nxa:getForeignRate executed successfully');
    }
}
