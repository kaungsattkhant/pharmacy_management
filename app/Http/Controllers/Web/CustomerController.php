<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(){
        $customers=Customer::where('branch_id',Auth::user()->branch_id)->get();
        return view('Customer.customer_index',compact('customers'));
    }

    public function search(Request $request)
    {
        $search=$request->search;
        if($search!=null){
            $customers=Customer::where(function ($q)use($search){
                $q->where('name','LIKE','%'.$search.'%')
                    ->orWhere('nrc','LIKE','%'.$search.'%')
                    ->orWhere('phone_number','LIKE','%'.$search.'%')->get();
            })->paginate(10);
            return view('Customer.customer_index',compact('customers'));
        }

    }
    public function store(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'email'=>"required|unique:customers|email",
            'address'=>'required',
            'phone_number'=>'required|unique:customers',
            'nrc'=>'required|unique:customers',
            'special_note'=>'nullable',
            'pulse_rate'=>'required',
        ]);
        if($vData->passes())
        {
            if($request->pulse_rate<100){
                $blood_pressure="Normal Or Increased";
            }elseif($request->pulse_rate>=100 || $request->pulse_rate<=120){
                $blood_pressure="Decreased";
            }elseif($request->pulse_rate>=120 || $request->pulse_rate<=140){
                $blood_pressure="Decreased";

            }elseif($request->pulse_rate>140){
                $blood_pressure="Decreased";

            }
            Customer::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'pulse_rate'=>$request->pulse_rate,
                'blood_pressure'=>$blood_pressure,
                'nrc'=>$request->nrc,
                'date_time'=>Carbon::today(),
                'special_note'=>$request->special_note,
                'branch_id'=>Auth::user()->branch_id,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Customer Create Successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function edit($id){
        return Customer::whereId($id)->firstOrfail();
    }
    public function update(Request $request){
        $vData=Validator::make($request->all(),[
            'name'=>"required",
            'email' => "required|email|unique:customers,email," .$request->id,
            'address'=>'required',
            'phone_number'=>'required|unique:customers,phone_number,'.$request->id,
            'nrc'=>'required|unique:customers,nrc,'.$request->id,
            'special_note'=>'nullable',
            'pulse_rate'=>'required',
        ]);
        if($vData->passes())
        {
            if($request->pulse_rate<100){
                $blood_pressure="Normal Or Increased";
            }elseif($request->pulse_rate>=100 || $request->pulse_rate<=120){
                $blood_pressure="Decreased";
            }elseif($request->pulse_rate>=120 || $request->pulse_rate<=140){
                $blood_pressure="Decreased";

            }elseif($request->pulse_rate>140){
                $blood_pressure="Decreased";

            }
            Customer::whereId($request->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'pulse_rate'=>$request->pulse_rate,
                'blood_pressure'=>$blood_pressure,
                'branch_id'=>Auth::user()->branch_id,
                'date_time'=>Carbon::today(),
                'nrc'=>$request->nrc,
                'special_note'=>$request->special_note,
            ]);
            return response()->json([
                'is_success'=>true,
                'message'=>'Customer Update Successfully',
            ]);
        }
        return response()->json([
            'errors'=>$vData->errors(),
        ]);
    }
    public function destroy(Request $request){
        Customer::find($request->id)->delete();
        return redirect('customer');
    }
}
