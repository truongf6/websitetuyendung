<?php

namespace App\Providers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layout.header', function ($view) {
            $count_newAppliedCv = 0; // Mặc định là 0 nếu người dùng chưa đăng nhập
            $newAppliedCv = collect(); // Mặc định là một collection rỗng nếu người dùng chưa đăng nhập

            if (Auth::check()) { // Kiểm tra xem người dùng có đăng nhập hay không
                $userId = Auth::user()->id;
                // Lấy số lượng hồ sơ ứng tuyển mới của người dùng
                $count_newAppliedCv = Application::where('status', null)
                    ->whereHas('job.user', function ($query) use ($userId) {
                        $query->where('id', $userId);
                    })->count();

                // Lấy danh sách hồ sơ ứng tuyển mới của người dùng
                $newAppliedCv = Application::where('status', null)
                    ->whereHas('job.user', function ($query) use ($userId) {
                        $query->where('id', $userId);
                    })->orderByDesc('id')->get();
            }

            // Truyền biến sang view
            $view->with('count_newAppliedCv', $count_newAppliedCv)
                ->with('newAppliedCv', $newAppliedCv);
        });
    }


}
