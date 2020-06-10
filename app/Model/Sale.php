<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $with=['staff','items'];
    protected $fillable=['date_time','total_kyats','staff_id','invoice_no'];
    public function staff(){
        return $this->belongsTo(Staff::class);
    }
    public function items(){
        return $this->belongsToMany(Item::class,'sale_item','sale_id','item_id')->withPivot('qty');
    }
}
