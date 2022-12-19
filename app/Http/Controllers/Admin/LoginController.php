<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);

    }
    public function store(Request $request){
        $this->validate($request,[
            'email' =>'required|email',
            'password' =>'required',
        ]);
        if(Auth::attempt(['email' => $request->input('email'),
        'password' => $request->input('password')
    ],$request->input('remember'))){
        return redirect()->route('admin.index');
        }else{
            session()->flash('error', 'Tài khoản hoặc mật khẩu chưa chính xác');
            return redirect()->back();

        }
    }
}
