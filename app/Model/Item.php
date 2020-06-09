<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=['name','price','category_id','qty','branch_id'];
    protected $with=['category','branch'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
