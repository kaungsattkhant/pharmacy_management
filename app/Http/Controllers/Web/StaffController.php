<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->isAdmin()){
            $staff=Staff::paginate(1);
        }elseif(Auth::user()->isManager()){
            $staff=Staff::where('branch_id',Auth::user()->branch_id)->paginate(1);
        }
        if($request->ajax()){
            return view('Staff.staff_index_filter',compact('staff'));
        }
        return view('Staff.staff_index',compact('staff'));
    }
    public function index_filter(Request $request){
        $staff=Staff::where('branch_id',$request->branch)->paginate(1);
        return view('Staff.staff_index_filter',compact('staff'));
    }
    public function store(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'email'=>"required|unique:staff|email",
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
            'role'=>'required',
            'branch'=>'nullable'
        ]);
        if($vData->passes())
        {
            Staff::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'role_id'=>$request->role,
                'branch_id'=>$request->branch,
                'password'=>bcrypt($request->password),
            ]);
            return response()->json([
                'success'=>true,
                'message'=>'StaffAuth create successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function edit($id){
        $staff=Staff::find($id);
        return $staff;
    }
    public function update(Request $request){
        $vData = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|unique:staff,email," .$request->id,
            'role' => 'required',
            'branch'=>'nullable',
        ]);
        if ($vData->passes()) {
            Staff::whereId($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'branch_id' => $request->branch,
            ]);
            return response()->json([
                'success'=>true,
                'message'=>'StaffAuth Update successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function destroy(Request $request)
    {
        $staff=Staff::find($request->id);
        $staff->delete();
        return redirect('/staff');
    }
}
