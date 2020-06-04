<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable=['name','address','phone_number'];
    public $timestamps=false;
}
