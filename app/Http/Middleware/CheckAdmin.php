<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa và có quyền admin hay không
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng về trang chủ hoặc trang lỗi
        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
