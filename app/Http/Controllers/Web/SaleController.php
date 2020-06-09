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
        $items = Item::where('name','LIKE',$request->search.'%')->get();
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
        $latest=Sale::latest()->first();
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
    public function sale_record(){
        $sales=Sale::paginate(10);
        return view('Sale.sale_record',compact('sales'));
    }
}
