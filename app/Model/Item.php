<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=['name','price','category_id','qty'];
    protected $with=['category'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
