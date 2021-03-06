<?php
namespace App\Traits\Sale;

use App\Model\Sale;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

trait SaleRecord{
    public function sale_filter_trait( $request,$branch_id){
        if(Auth::user()->isAdmin()){
            $sales=Sale::where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->paginate(1);
        }elseif(Auth::user()->isManager()){
            $branch_id=Auth::user()->branch_id;
            $sales=Sale::whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->paginate(1);
        }elseif(Auth::user()->isFrontMan()){
            $staff_id=Auth::user()->id;
            $sales=Sale::whereHas('staff',function ($q)use($staff_id){
                $q->whereId($staff_id);
            })->where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->paginate(1);
        }
        return $sales;
    }
    public function invoice_export($request,$branch_id){
        if(Auth::user()->isAdmin()){
                $sales=Sale::where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->get();
        }elseif(Auth::user()->isManager()){
            $branch_id=Auth::user()->branch_id;
            $sales=Sale::whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->get();
        }elseif(Auth::user()->isFrontMan()){
            $staff_id=Auth::user()->id;
            $sales=Sale::whereHas('staff',function ($q)use($staff_id){
                $q->whereId($staff_id);
            })->where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->get();
        }
        if($sales->isNotEmpty()){
            foreach($sales as $key=>$d){
                $a[$key]=new \stdClass();
                $a[$key]->invoice_no=$d->invoice_no;
                $a[$key]->date_time=$d->date_time;
                $a[$key]->total_kyats=$d->total_kyats;
                $a[$key]->staff_name=$d->staff->name;

            }
            return collect($a);
        }
    }
    public function reqiredData($data){
        foreach($data as $key=>$d){
//            dd($d);
            $a[$key]=new \stdClass();
            $a[$key]->invoice_no=$d->invoice_no;
            $a[$key]->date_time=$d->date_time;
            $a[$key]->total_kyats=$d->total_kyats;
            $a[$key]->staff_name=$d->staff->name;

        }
        return collect($a);
    }
}
