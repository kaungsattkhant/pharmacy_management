<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category=Category::all();
        return view('Category.category_index',compact('category'));
    }
    public function store(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
        ]);
        if($vData->passes()){
            Category::create([
                'name'=>$request->name,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Category create successfully',
            ]);

        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function edit($id){
        return Category::find($id);
    }
    public function update(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
        ]);
        if($vData->passes()){
            Category::whereId($request->id)->update([
                'name'=>$request->name,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Category update successfully',
            ]);

        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function destroy(Request $request){
        Category::find($request->id)->delete();
        return redirect('category');
    }

}
