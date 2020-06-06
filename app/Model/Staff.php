<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $with=['role','branch'];
    protected $fillable=['name','email','password','phone_number','branch_id','role_id'];
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
