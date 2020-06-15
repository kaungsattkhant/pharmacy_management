<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=['name','price','category_id','qty','branch_id','expire_date'];
    protected $with=['category','branch'];
    public function category(){
        return $this->belongsTo(Category::class)->orderBy('name');
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
