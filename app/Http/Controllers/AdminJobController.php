<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminJobController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 20;
    
        // Tạo query cơ bản để lấy các công việc chưa bị xóa
        $query = Job::query();
    
        // Kiểm tra điều kiện tìm kiếm theo từng trường
        if ($request->filled('search_poster')) {
            $query->whereHas('User', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search_poster . '%');
            });
        }
        
        if ($request->filled('search_company')) {
            $query->whereHas('Company', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search_company . '%');
            });
        }
        
        if ($request->filled('search_title')) {
            $query->where('title', 'LIKE', '%' . $request->search_title . '%');
        }
        
        if ($request->filled('search_position')) {
            $query->where('position', 'LIKE', '%' . $request->search_position . '%');
        }
        
        if ($request->filled('search_location')) {
            $query->where('location', 'LIKE', '%' . $request->search_location . '%');
        }
        
        if ($request->filled('search_type')) {
            $query->where('type', 'LIKE', '%' . $request->search_type . '%');
        }
        
        if ($request->filled('search_salary')) {
            $query->where('salary', 'LIKE', '%' . $request->search_salary . '%');
        }
    
        // Lấy danh sách công việc với phân trang và giữ các tham số tìm kiếm trong liên kết phân trang
        $Jobs = $query->orderByDesc('id')->paginate($perPage)->appends($request->all());
    
        return view('admin.Job.index', compact('Jobs'), [
            'title' => 'Quản lý công việc'
        ]);
    }

}
