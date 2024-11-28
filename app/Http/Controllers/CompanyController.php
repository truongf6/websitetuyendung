<?php

namespace App\Http\Controllers;

use App\Models\AdmminMoney;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use App\Models\setting;
use App\Models\Application;
use Illuminate\Support\Str;
use App\Models\Job_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CompanyController extends Controller
{
    use ValidatesRequests;

    public function postJobPage()
    {
        $job_categories = Job_Category::all();
        $money = setting::where('key', 'money')->pluck('value')->first();
        $companies = Company::where('user_id', Auth::user()->id)->get();

        return view('company.postJobPage', compact('job_categories','money','companies'), [
            'title' => 'Đăng tin tuyển dụng'
        ]);
    }

    // Ẩn bài đăng
    public function toggleHide(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->Hide = !$job->Hide; // Đổi trạng thái của Hide
        $job->save();

        return response()->json(['status' => 'success', 'Hide' => $job->Hide]);
    }

    //view 
    public function viewJobPage()
    {
        $Jobs = Job::where('user_id', Auth::user()->id)->paginate(20);
        return view('company.viewShowJob', compact('Jobs'), [
            'title' => 'Công việc đã đăng'
        ]); 
    }
    // Đăng tin
    public function postJob(Request $request)
    {
        $money_user = Auth::user()->money;
        $money_post =  setting::where('key', 'money')->pluck('value')->first();
            // Validation dữ liệu
        $this->validate($request, [
            'title' => 'required',
            'job_categories_id-select' => 'required',
            'type' => 'required',
            'position' => 'required',
            'salary' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề công việc.',
            'job_categories_id-select.required' => 'Vui lòng chọn danh mục công việc.',
            'type.required' => 'Vui lòng chọn loại hình công việc.',
            'salary.required' => 'Chưa điền thu nhập.',
            'position.required' => 'Vui lòng vị trí tuyển dụng.',
        ]);

        $categoryId = null;
        if ($request->input('job_categories_id-new')) {
            // Thêm danh mục mới vào database
            $newCategory = Job_Category::create([
                'title' => $request->input('job_categories_id-new'),
                'slug' => Str::slug($request->input('job_categories_id-new')), // Tạo slug từ tiêu đề
            ]);
            $categoryId = $newCategory->id;
        } else {
            // Sử dụng danh mục có sẵn
            $categoryId = $request->input('job_categories_id-select');
        }
        // Tạo slug từ tiêu đề
        $slug = Str::slug($request->input('title'));

        $user_id = Auth::user()->id;
        $company = Company::where('user_id', $user_id)
        ->where('name', $request->input('name'))
        ->first();
        if (!$company) {
            $this->validate($request, [
                'location' => 'required',
                'name' => 'required',
                'phone_number' => 'required|max:12',
            ], [
                'name.required' => 'Vui lòng nhập tên công ty.',
                'location.required' => 'Vui lòng địa chỉ nơi làm việc.',
                'phone_number.required' => 'Vui lòng nhập số điện thoại.',
                'phone_number.max' => 'Số điện thoại không được vượt quá 12 ký tự.',
            ]);
            $company = new Company;
            $company->user_id = $user_id;
            $company->name = $request->input('name');
            $company->phone_number = $request->input('phone_number');
            $company->description = $request->input('descriptionCompanyContent');
            $company->website = $request->input('website');
            $company->save();
        }

        // Xử lý ảnh logo của user (tương ứng với ảnh công ty)
        $image = $request->file('thumb-company'); // Lấy file ảnh từ file Upload

        if ($image) {
            // Tạo tên file theo slug của tên user (hoặc công ty) để đảm bảo tên file thân thiện
            $fileName = Str::slug($company->name) . '.jpg';  // Sử dụng Slug để tạo tên file thân thiện

            // Di chuyển ảnh vào thư mục lưu trữ (public/images/companys)
            $image->move(public_path('temp/images/company'), $fileName);

            // Cập nhật đường dẫn thumb (ảnh) trong bảng companys
            $company->thumb = $fileName; // Lưu tên file ảnh vào cột thumb trong bảng companys
            $company->save(); // Lưu lại thông tin user với đường dẫn ảnh mới
        }

        // Lưu thông tin công việc vào DB
        $job = new Job;
        $job->user_id = $user_id;
        $job->title = $request->input('title');  // Hoặc $request->title
        $job->slug = $slug . $job->id;  // Tạo slug từ tiêu đề
        $image = $request->file('thumb'); // Lấy file ảnh từ file Upload
        if ($image) {
            $fileName = $job->slug . '.jpg'; // Tên ảnh theo Slug Title
            //   $avatar->storeAs('public/images/avatars', $fileName); // Lưu ảnh đã thêm vào đường dẫn này
            $image->move(public_path('temp/images/job'), $fileName); // Di chuyển ảnh vào thư mục này

            $job->thumb = $fileName; // Lưu tên file ảnh theo slug Title
        }
        $job->job_categories_id = $categoryId;
        $job->type = $request->input('type');
        $job->position = $request->input('position');
        $job->location = $request->input('location');
        $job->salary = $request->input('salary');
        $job->gender = $request->input('gender');
        $job->Experience = $request->input('Experience');
        $job->description = $request->input('description');
        $job->requirements = $request->input('requirement');
        $job->expires_at = $request->input('expires');
        $job->company_id = $company->id;
        $job->save();

        $user = User::find(Auth::user()->id);
        $user->money -= $money_post;
        $user->save();

        $admin_money = new AdmminMoney;
        $admin_money->amount = $money_post;
        $admin_money->description = "Chi phí đăng bài của công ty ". $company->name;
        $admin_money->user_id = Auth::user()->id;
        $admin_money->save();
        return response()->json(['success' => 'Công việc đã được đăng thành công!', 'job' => $job], 200);
    }
    public function viewJobPageEdit($slug)
    {
        $Jobs = Job::where('slug', $slug)->first();
    
        // Kiểm tra nếu $Jobs tồn tại và định dạng lại expires_at
        if ($Jobs && $Jobs->expires_at) {
            $Jobs->expires_at = Carbon::parse($Jobs->expires_at)->format('Y-m-d');
        }
    
        $job_categories = Job_Category::all();
    
        return view('company.EditJobPage', compact('Jobs', 'job_categories'), [
            'title' => $Jobs->title
        ]);
    }
    
    public function PostJobPageEdit(Request $request, $slug)
    {
        // Validation dữ liệu
        $this->validate($request, [
            'title' => 'required',
            'job_categories_id-select' => 'required',
            'type' => 'required',
            'position' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'description' => 'required',
            'name' => 'required',
            'phone_number' => 'required|max:12',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề công việc.',
            'job_categories_id-select.required' => 'Vui lòng chọn danh mục công việc.',
            'type.required' => 'Vui lòng chọn loại hình công việc.',
            'description.required' => 'Vui lòng nhập mô tả công việc.',
            'name.required' => 'Vui lòng nhập tên công ty.',
            'salary.required' => 'Chưa điền thu nhập.',
            'position.required' => 'Vui lòng vị trí tuyển dụng.',
            'location.required' => 'Vui lòng địa chỉ nơi làm việc.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 12 ký tự.',
        ]);
    
        // Xử lý danh mục công việc
        $categoryId = $request->input('job_categories_id-select');
        if ($request->input('job_categories_id-new')) {
            $newCategory = Job_Category::create([
                'title' => $request->input('job_categories_id-new'),
                'slug' => Str::slug($request->input('job_categories_id-new'))
            ]);
            $categoryId = $newCategory->id;
        }
    
        // Kiểm tra slug để tránh trùng lặp với các job khác
        $newSlug = Str::slug($request->input('title'));  // Tạo slug mới từ tiêu đề
        if (Job::where('slug', $newSlug)->where('slug', '!=', $slug)->exists()) {
            return response()->json(['error' => 'Tiêu đề đã tồn tại, vui lòng nhập tiêu đề khác.'], 422);
        }
    
        // Tìm công việc theo slug từ URL
        $job = Job::where('slug', $slug)->firstOrFail();
    
        // Lấy user_id hiện tại
        $user_id = Auth::user()->id;
    
        // Tìm công ty và cập nhật
        $company = Company::where('id', $job->company_id)->firstOrFail();
        $company->name = $request->input('name');
        $company->phone_number = $request->input('phone_number');
        $company->description = $request->input('descriptionCompanyContent');
        $company->website = $request->input('website');
    
        // Cập nhật logo công ty nếu có
        if ($request->hasFile('thumb-company')) {
            $image = $request->file('thumb-company');
            $fileName = Str::slug($company->name) . '.jpg';
            $image->move(public_path('temp/images/company'), $fileName);
            $company->thumb = $fileName;
        }
        $company->save();
    
        // Cập nhật thông tin công việc
        $job->user_id = $user_id;
        $job->title = $request->input('title');
        $job->slug = $newSlug;
        $job->job_categories_id = $categoryId;
        $job->type = $request->input('type');
        $job->position = $request->input('position');
        $job->location = $request->input('location');
        $job->salary = $request->input('salary');
        $job->gender = $request->input('gender');
        $job->Experience = $request->input('Experience');
        $job->description = $request->input('description');
        $job->requirements = $request->input('requirement');
        $job->expires_at = $request->input('expires');
        $job->company_id = $company->id;
    
        // Cập nhật ảnh công việc nếu có
        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');
            $fileName = $job->slug . '.jpg';
            $image->move(public_path('temp/images/job'), $fileName);
            $job->thumb = $fileName;
        }
        $job->save();
    
        return response()->json(['success' => 'Công việc đã được cập nhật thành công!', 'job' => $job], 200);
    }
    

    public function listApplications($id)
    {
        // Lấy thông tin công việc
        $job = Job::findOrFail($id);

        // Lấy danh sách các đơn ứng tuyển cho công việc này
        $applications = Application::where('job_id', $id)->with('user')->get();

        // Trả về view hiển thị danh sách
        return view('company.listCvApplied', compact('job', 'applications'),[
            'title' => 'Danh sách CV đã ứng tuyển'
        ]);
    }

     // Duyệt đơn ứng tuyển
     public function approve($id)
     {
         $application = Application::findOrFail($id);
         $application->status = 1; // 1 = Đã duyệt
         $application->save();
 
         return response()->json(['success' => true, 'message' => 'Đơn ứng tuyển đã được duyệt!']);
     }
 
     // Hủy đơn ứng tuyển
     public function reject($id)
     {
         $application = Application::findOrFail($id);
         $application->status = 0; // 0 = Đã từ chối
         $application->save();
 
         return response()->json(['success' => true, 'message' => 'Đơn ứng tuyển đã bị hủy!']);
     }
}
