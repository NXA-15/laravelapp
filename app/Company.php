<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
     protected $fillable = ['name', 'email', 'website', 'address', 'phone_number'];

     public function employee()
     {
         return $this->hasMany(Employee::class);
     }


}