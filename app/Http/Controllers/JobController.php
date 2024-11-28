<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Favourite;
use App\Models\Application;
use Illuminate\Support\Str;
use App\Models\Job_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class JobController extends Controller
{
    use ValidatesRequests;
    public function jobList(Request $request)
    {
        $query = Job::where(function ($q) {
            $q->where('Hide', '!=', true)
              ->orWhereNull('Hide'); // Bao gồm cả trường hợp Hide = NULL
        });    
        // Tìm kiếm theo tiêu đề công việc
        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
    
        // Tìm kiếm theo tên công ty
        if ($request->filled('company')) {
            $query->whereHas('Company', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->company . '%');
            });
        }
    
        // Tìm kiếm theo địa chỉ công ty (Company->location)
        if ($request->filled('location')) {
            $query->whereHas('Company', function ($q) use ($request) {
                $q->where('location', 'LIKE', '%' . $request->location . '%');
            });
        }
    
        // Tìm kiếm theo danh mục công việc
        if ($request->filled('category')) {
            $query->whereHas('Category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }
    
        // Tìm kiếm theo loại hình công việc
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        $Jobs = $query->orderByDesc('created_at')->paginate(10);
        $count_job = $Jobs->total();
        $categories = Job_Category::all();
        $topCompanies = Job::select('company_id', DB::raw('COUNT(*) as job_count'))
        ->groupBy('company_id')
        ->orderByDesc('job_count')
        ->with('company') // Eager load thông tin công ty
        ->take(8)
        ->get();
        return view('job.jobList', compact('Jobs', 'count_job', 'categories','topCompanies'), [
            'title' => 'Danh sách tuyển dụng',
        ]);
    }
    

    

    // Xem preview Bài đăng
    public function jobDetail($slug)
    {

        // Tìm job theo slug
        $job = Job::where('slug', $slug)->first();

        $favourite = null;
        if (Auth::check()) {
            $favourite = Favourite::where('user_id', Auth::user()->id)->where('job_id',$job->id)->first();
        }
        // Kiểm tra nếu không tìm thấy job
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found!');
        }
    
        $user = null;
        $company = null;
    
        if ($job->user_id != null) {
            $user = User::find($job->user_id);
    
            // Kiểm tra nếu tìm thấy user, lấy company tương ứng
            if ($user) {
                $company = Company::where('user_id', $user->id)->first();
            }
        }
    
        $hasApplyJob = Application::where('user_id', Auth::id())
            ->where('job_id', $job->id)
            ->first();
        $job_referencts = Job::Where('Hide','!=',true)->orWhereNull('Hide')->where('job_categories_id',$job->job_categories_id)->take(6)->get();
        return view('job.jobDetail', compact('job', 'user', 'company', 'hasApplyJob', 'favourite','job_referencts'), [
            'title' => $job->title
        ]);
    }
    

    public function applyJob(Request $request, $slug){
        $this->validate($request, [
            'name' =>'required|max:255',
            'phone_number' =>'required|max:20',
            'cv' => 'required|mimes:pdf'
        ],
    [
            'name' => 'Vui lòng nhập tên đầy đủ!',
            'phone_number' => 'Vui lòng nhập số điện thoại!',
            'cv' => 'Vui lòng tải file CV!'
            
        ]);
        $job = Job::where('slug', $slug)->first();
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->save();

        $application = new Application;
        $application->user_id = Auth::user()->id;
        $application->job_id = $job->id;
        $cv = $request->file('cv'); 

        if ($cv) {
            $fileName = $user->name . '.pdf'; 
            $cv->move(public_path('temp/cvs'), $fileName);

            $application->fileCv = $fileName; 
        }
        $application->save(); 

        return redirect()->route('jobDetail',['slug' => $slug]);
    }

    public function CvApplied(){
        $applications = Application::where('user_id', Auth::id())->paginate(20);
        return view('job.CvApplied',compact('applications'),[
            'title' => 'CV đã ứng tuyển'
        ]);
    }

}
