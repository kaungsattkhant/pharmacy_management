<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Branch;
use App\Model\Item;
use App\Model\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
//    public function index(){
//        return view('Sale.sale_index');
//    }
    public function index(){
        return view('Sale.sale_index');
    }
    public function get_item_name(Request $request){
        $items = Item::where('name','LIKE',$request->search.'%')
            ->orderBy('name','asc')
            ->where('branch_id',Auth::user()->branch_id)
            ->get();
        if($items->isNotEmpty()){
            return response()->json([
                'is_success'=>true,
                'items'=>$items
            ]);
        }else{
            return response()->json([
                'is_success'=>false,
            ]);
        }
    }
    public function sale_create(Request $request){
        $data=json_encode($request->items);
        $decode_data=json_decode($data);
        $branch_id=Auth::user()->branch_id;
        $latest=Sale::whereHas('staff',function ($q)use($branch_id){
            $q->where('branch_id',$branch_id);
        })->latest()->first();
        $branch=Branch::find(Auth::user()->branch_id);
        $invoice_no=$this->getInvoiceNo($branch,$latest);
        $sale=Sale::create([
            'invoice_no'=>$invoice_no,
            'date_time'=>Carbon::now(),
            'staff_id'=>Auth::user()->id,
            'total_kyats'=>$request->total,
        ]);
        foreach($decode_data as $item) {

            $it=Item::whereId($item->id)->first();
            if($it!=null){
                $update_qty=$it->qty-$item->qty;
                $it->update([
                    'qty'=>$update_qty
                ]);
            }
                $sale->items()->attach($item->id, ['qty' => $item->qty]);
        }
        return response()->json([
            'is_success'=>true,
        ]);
    }
    protected function  getInvoiceNo($branch,$last_sale){
//        $tr_date=Carbon::parse($last_transaction->date_time);
        $num=0;
        if($last_sale!=null){

            $date=$last_sale->date_time;
            $last_invoice=$last_sale->invoice_no;
            $num=substr($last_invoice,-5);
        }else{
            $date=Carbon::now();
            $num=0;
        }

//        $first=substr($branch->name,0,1);
        $last=$branch->id;
        $from = Carbon::parse($date)->startOfDay();
        $to = Carbon::parse(Carbon::today())->startOfDay();
        $d=$to->diffIndays($from);
        if($d<=0){
            $a=(str_pad((int)$num + 1, 5, '0', STR_PAD_LEFT));
        }
        else if($d>=1)
        {
            $num=0;
            $a=(str_pad((int)$num + 1, 5, '0', STR_PAD_LEFT));
        }
        $date= str_replace("-", "", Carbon::today()->format('d-m-Y'));
        $invoice_no="B".$last.$date.$a;
        return $invoice_no;
    }
    public function sale_record(Request $request){
        $date=Carbon::today();
        if(Auth::user()->isAdmin()){
            $sales=Sale::whereDate('date_time',$date)->paginate(10);
        }elseif(Auth::user()->isManager()){
            $branch_id=Auth::user()->branch_id;
            $sales=Sale::whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->whereDate('date_time',$date)->paginate(10);
        }elseif(Auth::user()->isFrontMan()){
            $staff_id=Auth::user()->id;
            $sales=Sale::whereHas('staff',function ($q)use($staff_id){
                $q->whereId($staff_id);
            })->whereDate('date_time',$date)->paginate(10);
        }
        if($request->ajax()){
            return view('Sale.sale_record_filter',compact('sales'));
        }
        return view('Sale.sale_record',compact('sales'));
    }
    public function sale_record_filter(Request $request){
        if($request->branch){
            $branch_id=$request->branch;
        }else{
            $branch_id=Auth::user()->branch_id;
        }
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
            return view('Sale.sale_record_filter',compact('sales'));
    }
    public function sale_detail($sale_id){
        $sale=Sale::whereid($sale_id)->firstOrfail();
        $items=$sale->items;
//        foreach($items->pivot as $p){
//            dd($p);
//        }
        return view('Sale.detail_view',compact('items'));
    }
    public function sale_report(){

        $branch_id=Auth::user()->branch_id;
        $now = Carbon::now();
        $today = $now->today();
        $c_month = $now->month;
        $c_year = $now->year;
        $dayInMonth = Carbon::now()->daysInMonth;
        $days = [];
        $avg_sale=[];
        for ($i = 1; $i <= $dayInMonth; $i++) {
            $date = Carbon::parse($c_year . '-' . $c_month . '-' . $i);
            $sale=Sale::whereDate('date_time',$date)
                ->whereHas('staff',function ($q)use($branch_id){
                    $q->where('branch_id',$branch_id);
                })
                ->get();
            $total_sale=0;
            foreach($sale as $s)
            {
                foreach($s->items as $t){
                    $total_sale+=$t->price * $t->pivot->qty;
                }
            }
            array_push($days, $i);
            array_push($avg_sale, $total_sale);
        }
            return view('Sale.sale_report',compact('days','avg_sale'));
    }
    public function sale_report_filter(Request $request){
        $branch_id=$request->branch;
        $month = $request->month;
        $year = $request->year;
        $req_date = Carbon::parse($request->year . '-' . $request->month);
        $dayInMonth = $req_date->daysInMonth;
        $days = [];
        $avg_sale=[];
        for ($i = 1; $i <= $dayInMonth; $i++) {
            $date = Carbon::parse($year . '-' . $month . '-' . $i);
            $sale=Sale::whereDate('date_time',$date)
                ->whereHas('staff',function ($q)use($branch_id){
                    $q->where('branch_id',$branch_id);
                })
                ->get();
            $total_sale=0;
            if($sale->isNotEmpty()){
                foreach($sale as $s)
                {
                    foreach($s->items as $t){
                        $total_sale+=$t->price * $t->pivot->qty;
                    }
                }
            }

            array_push($days, $i);
            array_push($avg_sale, $total_sale);
        }
//        dd($days);
//        dd($avg_sale);
        return response()->json([
            'days' => $days,
            'avg_sale' => $avg_sale,
            'label'=>'Sale Average Rate',
        ]);
    }
    public function item_report(Request $request){
        $branch_id=1;
        $items=Item::orderBy('name','asc')->where('branch_id',1)->paginate(3);
        foreach($items as $it){
            $sales=Sale::whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->whereDate('date_time',Carbon::today())->get();
            $total_sale=0;
            $total_qty=0;
            foreach($sales as $s){
                foreach($s->items as $p){
                    if($p->id== $it->id){
                       $total_sale+= $p->price *$p->pivot->qty;
                       $total_qty+=$p->pivot->qty;
                    }
                }
            }
            $it->sale=$total_sale;
            $it->total_qty=$total_qty;
        }
        if($request->ajax()){
            return view('Sale.item_report_filter',compact('items'));
        }
        return view('Sale.item_report',compact('items'));
    }
    public function item_report_filter(Request $request){

        $branch_id=$request->branch;
        $items=Item::orderBy('name','asc')->where('branch_id',$request->branch)->paginate(3);
        foreach($items as $it){
            $sales=Sale::whereHas('staff',function ($q)use($branch_id){
                $q->where('branch_id',$branch_id);
            })->where(function ($q)use($request) {
                $q->whereDate('date_time', '>=', $request->from_date)
                    ->whereDate('date_time', '<=', $request->to_date);
            })->get();
            $total_sale=0;
            $total_qty=0;
            foreach($sales as $s){
                foreach($s->items as $p){
                    if($p->id== $it->id){
                        $total_sale+= $p->price *$p->pivot->qty;
                        $total_qty+=$p->pivot->qty;
                    }
                }
            }
            $it->sale=$total_sale;
            $it->total_qty=$total_qty;
        }
        return view('Sale.item_report_filter',compact('items'));
    }
}
