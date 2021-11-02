<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'photo', 'phone_number', 'address'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}