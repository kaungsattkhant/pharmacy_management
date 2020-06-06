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
            'email' => 'required|string|email|max:255|exists:staff,email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])) {
            return redirect()->intended('staff');
        }
        return redirect('login');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
