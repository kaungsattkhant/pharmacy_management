<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Item;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index(){
        return view('POS.pos_index');
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
}
