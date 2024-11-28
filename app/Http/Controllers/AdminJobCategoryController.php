<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Job_Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminJobCategoryController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 20; // Số bản ghi trên mỗi trang

        // Tạo query cơ bản để lấy các danh mục chưa bị xóa
        $query = Job_Category::query();  // Sử dụng query builder

        // Kiểm tra điều kiện tìm kiếm
        if ($request->has('search_id') && $request->search_id) {
            $query->where('id', $request->search_id);
        }
        if ($request->has('search_name') && $request->search_name) {
            $query->where('title', 'LIKE', '%' . $request->search_name . '%');
        }

        // Lấy danh sách các danh mục với phân trang và thêm các tham số tìm kiếm vào liên kết phân trang
        $job_categories = $query->orderByDesc('id')->paginate($perPage)->appends($request->only('search_id', 'search_name'));
        $parent_ids = Job_Category::all();
        return view('admin.job_category.index', compact('job_categories','parent_ids'), [
            'title' => 'Quản lý danh mục công việc'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:job_categories',
        ], [
            'title.required' => 'Vui lòng nhập tên Danh mục!',
            'slug.required' => 'Vui lòng nhập Slug!',
            'slug.unique' => 'SLug này đã bị trùng!',
        ]);
    
        $job_category = new Job_Category();
        $job_category->title = $request->title;
        $job_category->slug = $request->slug;
        $job_category->desc = $request->desc;
        $job_category->parent_id = $request->parent_id;
        $job_category->save();
    
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Job_Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Không tìm thấy danh mục với ID: ' . $id
            ], 404); 
        }

        return response()->json($category); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job_Category $job_Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('job_categories')->ignore($id),
            ],
        ], [
            'title.required' => 'Vui lòng nhập tên Danh mục!',
            'slug.required' => 'Vui lòng nhập Slug!',
            'slug.unique' => 'Slug này đã bị trùng!',
        ]);
        $job_Category = Job_Category::find($id);
        $job_Category->title = $request->title;
        $job_Category->slug = $request->slug;
        $job_Category->desc = $request->desc;
        $job_Category->parent_id = $request->parent_id;
        $job_Category->save();
    
        return redirect()->back();
    }
    
    
    
    
    /**
     * Remove the specified resource from storage.
     */    public function destroy(string $id)
    {
        $job_category = Job_Category::find($id);

        if (!$job_category) {
            return response()->json([
               'message' => 'Không tìm thấy danh mục với ID: '. $id
            ], 404); 
        }
        $job_category->delete();
        return response()->json([
           'message' => 'Đã xóa danh mục ID: '. $id
        ], 200);
    }
}
