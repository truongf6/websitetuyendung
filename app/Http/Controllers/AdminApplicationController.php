<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20;

        // Query lấy danh sách ứng tuyển
        $query = Application::query()->with(['user', 'job', 'job.company']);

        // Tìm kiếm theo tên người ứng tuyển
        if ($request->filled('search_applicant')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search_applicant . '%');
            });
        }

        // Tìm kiếm theo email người ứng tuyển
        if ($request->filled('search_email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'LIKE', '%' . $request->search_email . '%');
            });
        }

        // Tìm kiếm theo trạng thái ứng tuyển
        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

        // Tìm kiếm theo tiêu đề công việc
        if ($request->filled('search_job')) {
            $query->whereHas('job', function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search_job . '%');
            });
        }

        // Tìm kiếm theo tên công ty
        if ($request->filled('search_company')) {
            $query->whereHas('job.company', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search_company . '%');
            });
        }

        // Lấy danh sách với phân trang
        $applications = $query->orderByDesc('created_at')->paginate($perPage)->appends($request->all());

        return view('admin.application.index', compact('applications'), [
            'title' => 'Quản lý đơn ứng tuyển',
        ]);
    }

}
