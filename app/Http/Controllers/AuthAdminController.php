<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthAdminController extends Controller
{
    use ValidatesRequests;

    public function login(Request $request)
    {
        // Validate email và password
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'email.email' => 'Email không hợp lệ'
        ]);
    
        // Lấy thông tin email và password
        $credentials = $request->only('email', 'password');
    
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, kiểm tra role_id
            if (Auth::user()->role_id == 1) {
                // Chuyển hướng đến trang admin nếu role_id = 1
                return redirect()->intended('/admin')->with('success', 'Đăng nhập thành công');
            }
    
            // Đăng xuất nếu role_id không phải là admin
            Auth::logout();
            return back()->withErrors([
                'email' => 'Tài khoản không có quyền truy cập',
            ])->withInput($request->only('email'));
        }
    
        // Đăng nhập thất bại, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ])->withInput($request->only('email'));
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');    
    }
}
