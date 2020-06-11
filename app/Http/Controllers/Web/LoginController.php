<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class LoginController extends Controller
{
    public function index(){
        return view('Login.login_index');
    }
    public function login(Request $request){
        request()->validate([
//            'email' => 'required|string|email|max:255|exists:staff,email',
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])) {
            if(Auth::user()->isAdmin()){
                return redirect()->intended('staff');
            }elseif(Auth::user()->isFrontMan()){
                return redirect()->intended('sale');
            }elseif(Auth::user()->isManager()){
                return redirect()->intended('item');
            }
        }
        return redirect('login');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
