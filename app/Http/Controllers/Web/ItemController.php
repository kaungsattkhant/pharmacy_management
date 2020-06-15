<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(Request $request){
        $items=Item::orderBy('name','asc')->where('branch_id',1)->paginate(10);
        if($request->ajax()){
            return view('Item.item_index_filter',compact('items'));
        }
        return view('Item.item_index',compact('items'));
    }
    public function index_filter(Request $request){
//        dd($request->all());
        if($request->sort_by=="sort_by_alphabet"){
            $items=Item::where('branch_id',$request->branch)->orderBy('name','asc')->paginate(10);

        }elseif($request->sort_by=="sort_by_qty"){
            $items=Item::where('branch_id',$request->branch)->orderBy('qty','asc')->paginate(10);

        }elseif($request->sort_by=="sort_by_price"){
            $items=Item::where('branch_id',$request->branch)->orderBy('price','desc')->paginate(10);

        }elseif($request->sort_by=="sort_by_expire_date"){
            $items=Item::where('branch_id',$request->branch)->orderBy('expire_date','asc')->paginate(10);

        }
        elseif($request->sort_by=="sort_by_category"){
//            $items=Item::where('branch_id',$request->branch)->whereHas('category',function ($q){
//                dd($q);
//                $q->orderBy('name','asc')->get();
//                dd($q);
//                })->paginate(10);
            $items=Item::where('branch_id',$request->branch)->paginate(10);
        }
//        $items=Item::where('branch_id',$request->branch)->orderBy('name','asc')->paginate(10);
        return view('Item.item_index_filter',compact('items'));
    }
    public function store(Request $request){
//        dd($request->all());
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'price'=>"required|integer",
            'qty'=>'required',
            'category'=>'required',
            'branch'=>'required',
            'expire_date'=>'required',
        ]);
        if($vData->passes())
        {
            Item::firstOrCreate(['name'=>$request->name,
                    'branch_id'=>$request->branch,
                    ],
                [
                    'price'=>$request->price,
                    'qty'=>$request->qty,
                    'category_id'=>$request->category,
                    'expire_date'=>$request->expire_date,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Item create successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);


    }
    public function edit($id){
        return Item::find($id);
    }
    public function update(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'price'=>"required|integer",
            'qty'=>'required|integer',
            'category'=>'required',
            'branch'=>'required',
            'expire_date'=>'required',

        ]);
        if($vData->passes()){
            Item::whereId($request->id)->update([
                'name'=>$request->name,
                'price'=>$request->price,
                'qty'=>$request->qty,
                'category_id'=>$request->category,
                'branch_id'=>$request->branch,
                'expire_date'=>$request->expire_date,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Item update successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function item_add_qty(Request $request){
        $vData=Validator::make($request->all(),[
            'qty'=>'required|integer',
        ]);
        if($vData->passes()){
            $remain=Item::find($request->id);
            $total=$remain->qty+$request->qty;
            Item::whereId($request->id)->update([
                'qty'=>$total,
            ]);
            return redirect('item');
        }
        return redirect('item');

    }
    public function search(Request $request)
    {
        $search=$request->search;
        if($search!=null)
        {
            $items=Item::where('name','LIKE','%'.$search.'%')
                ->orWhereHas('category', function($q) use($search) {
                    $q->where('name', 'like', '%' .$search. '%');
                })
                ->paginate(10);
//            $time=Item::where()
            return view('Item.item_index',compact('items'));
        }
    }
    public function destroy(Request $request)
    {
        $item=Item::find($request->id)->delete();
//        $item->delete();
        return redirect('/item');
    }

}
