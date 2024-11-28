<?php

namespace App\Http\Controllers;

use App\Models\AdmminMoney;
use App\Models\Application;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\Job;
use App\Models\Job_Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminHomeController extends Controller
{
    public function index(){
        $count_userAdmin = User::where('role_id',1)->count();
        $count_employee= User::where('role_id',3)->count();
        $count_company= User::where('role_id',2)->count();
        $job_cate= Job_Category::count();
        $job= Job::count();
        $company= Company::count();
        $post= Post::count();
        $applied= Application::count();
        $feedback= Feedback::count();

        $tongdoanhthu = AdmminMoney::Sum('amount');
        $tongdoanhthuHomNay = AdmminMoney::whereDate('created_at', Carbon::today())->sum('amount');
        $tongdoanhthuThangNay = AdmminMoney::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');
    
        return view('admin.home',compact('tongdoanhthu','tongdoanhthuHomNay','tongdoanhthuThangNay','count_userAdmin','count_employee','count_company','job_cate','job','company','post','applied','feedback'),[
            'title' => 'Trang chủ'
        ]);
    }

    public function history(Request $request)
    {
        $query = AdmminMoney::query();
    
        // Lọc theo số tiền (amount)
        if ($request->filled('amount')) {
            $query->where('amount', '>=', $request->amount);
        }
    
        // Lọc theo người dùng (user_id hoặc tên người dùng)
        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->user . '%');
            })->orWhere('user_id', $request->user);
        }
    
        // Lọc theo ngày (created_at)
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
    
        // Lấy dữ liệu đã lọc và phân trang
        $history = $query->orderByDesc('id')->paginate(20)->appends($request->all());
        $tongdoanhthu = AdmminMoney::Sum('amount');
        $tongdoanhthuHomNay = AdmminMoney::whereDate('created_at', Carbon::today())->sum('amount');
        $tongdoanhthuThangNay = AdmminMoney::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');
    
        return view('admin.history.index', compact('history','tongdoanhthu','tongdoanhthuHomNay','tongdoanhthuThangNay'), [
            'title' => 'Lịch sử doanh thu',
        ]);
    }
    
}
