<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index(){
        $branch=Branch::all();
        return view('Branch.branch_index',compact('branch'));
    }
    public function store(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'phone_number'=>"required|unique:branches",
            'address'=>'required'
        ]);
        if($vData->passes())
        {
            Branch::create([
                'name'=>$request->name,
                'phone_number'=>$request->phone_number,
                'address'=>$request->phone_number,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Branch create successfully',
            ]);
        }else{
            return response()->json([
                'errors'=>$vData->errors(),
            ]);
        }
    }
    public function edit($id){
        return Branch::find($id);
    }
    public function update(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'phone_number'=>"required|unique:branches,phone_number,".$request->id,
            'address'=>'required'
        ]);
        if($vData->passes())
        {
            Branch::whereId($request->id)->update([
                'name'=>$request->name,
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Branch update successfully',
            ]);
        }else{
            return response()->json([
                'errors'=>$vData->errors(),
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $staff=Branch::find($request->id);
        $staff->delete();
        return redirect('/branch');
    }
}
