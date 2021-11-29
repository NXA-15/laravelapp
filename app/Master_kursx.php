<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_kursx extends Model
{
    protected $fillable = ['currency', 'value', 'selling_rate', 'buying_rate'];
    //protected $primaryKey = 'currency';

    //
    public function storeData($input)
    {
    	return static::create($input);
    }

}
