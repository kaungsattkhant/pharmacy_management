<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['name','email','address','phone_number','pulse_rate','blood_pressure','branch_id'];
}
