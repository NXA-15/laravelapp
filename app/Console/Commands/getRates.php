<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Master_kursx;

class getRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxa:getRates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'foreign exhange rates from BTPN';

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
        $urlBTPN = file_get_contents('https://www.btpn.com/id/prime-lending-rate/kurs');

        /* preg_match('#<span[^<>]*>([\d,]+).*?</span>#', $urlBI, $match_date);
        $get_update_date = $match_date[0];
        $lastUpdate = str_replace(['<span>','</span>'],'',$get_update_date); */


                preg_match_all('#<table[^>]+>(.+?)</table>#ims',$urlBTPN, $matches);
                $table = $matches[0][0];
                preg_match_all('#<tr [^>]+>(.+?)>(.+?)</tr>#ims', $table, $matches2);

                foreach($matches2[0] as $key => $value)
                {
                  /*   if ($key < 14) {
                        continue;
                    } */
                    preg_match_all('#<td>(.+?)</td>#ims', $value, $matches3);
                    if (isset($matches3[0][0])) {
                        /* $free = trim(strip_tags($value));
                        $currency = substr($free, 0, 3); */
                       /*  $currency = $matches3[0][0];
                       */
                        $currency = $matches3[0][0];
                        $currencyx = str_replace(['<td>','</td>'],'',$currency);
                        //$nilai = $matches3[0][1];
                        $nilai_satuan = 1;
                        $sale = $matches3[1][2];
                        $selling_rate = str_replace(['<td style="width: 33%;">','</td>'],'',$sale);
                        $buy = $matches3[1][1];
                        $buying_rate = str_replace(['<td style="width: 33%;">','</td>'],'',$buy);

                        $master_kurs = new Master_kursx;
                        $master_kurs->currency = $currencyx;
                        $master_kurs->value = $nilai_satuan;
                        $master_kurs->selling_rate = str_replace(',', '.',str_replace('.', '', $selling_rate));
                        $master_kurs->buying_rate = str_replace(',', '.',str_replace('.', '', $buying_rate));
                        $master_kurs->last_update = '2021-11-29';
                        if($currencyx == 'INR / IDR'){
                            $master_kurs->save();
                        }

                    }
                }


        $this->info('command nxa:getRate executed successfully');
    }
}
