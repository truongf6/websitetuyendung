<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends Controller
{
    use ValidatesRequests;

    public function showRegister(){
        return view('auth.register',[
            'title' => 'Đăng ký tài khoản',
        ]);
    }

    /**
     * Đăng ký tài khoản.
     * @param Request $request
     */
    public function register(Request $request)
    {
       // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password'
        ], [
            'name.required' => 'Vui lòng nhập tên của bạn!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
            'confirmPassword.required' => 'Vui lòng xác nhận mật khẩu!',
            'confirmPassword.same' => 'Mật khẩu xác nhận không khớp!'
        ]);
        $confirmPass = $request->confirmPassword;
        $pass = $request->password;
        if ($confirmPass == $pass) {
            // Kiểm tra xem email đã tồn tại chưa
            $emailExists = User::where('email', $request->email)->exists();

            if (!$emailExists) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role_id = $request->type;
                $user->save();
                Auth::login($user);
            } else {
                return back()->with('error', 'Email đã tồn tại');
            }
        } else {
            return back()->with('error', 'Xác nhận lại mật khẩu !');
        }
        return redirect('/'); // Điều hướng sau khi đăng ký
    }

    
    public function showLogin(){
        return view('auth.login',[
            'title' => 'Đăng nhập'
        ]);
    }

    /**
     * Đăng nhập.
     * @param Request $request
     */
   
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
             // Đăng nhập thành công
             return redirect()->intended('/')->with('success', 'Đăng nhập thành công');
         }
     
         // Đăng nhập thất bại, trả về thông báo lỗi
         return back()->withErrors([
             'email' => 'Email hoặc mật khẩu không đúng',
         ])->withInput($request->only('email'));
     }

    /**
     * Đăng xuất.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('showLogin');    
    }
}
