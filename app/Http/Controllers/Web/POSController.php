<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Item;
use App\Model\Sale;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index(){
            $sales=Sale::paginate(10);
        return view('POS.pos_index',compact('sales'));
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
    public function pos_create(Request $request){
//        dd($request->all());
    }
}
