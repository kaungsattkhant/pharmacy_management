<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

use Illuminate\Database\Eloquent\Model;

class Staff extends Authenticable
{
    protected $with=['role','branch'];
    protected $fillable=['name','email','password','phone_number','branch_id','role_id'];
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function isAdmin(){
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == 'Admin')
            {
                return true;
            }
        }
    }
    public function isFrontMan(){
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == 'FrontMan')
            {
                return true;
            }
        }
    }
}
