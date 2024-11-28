<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function JobSaved(){
        $favourites = Favourite::where('user_id',Auth::user()->id)->paginate(20);
        return view('profile.employee.favourite',compact('favourites'),[
            'title' => 'Công việc đã lưu'
        ]);
    }

    public function store(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Bạn cần đăng nhập để lưu công việc'], 401);
        }

        $user_id = Auth::id();
        $job_id = $request->input('job_id');

        // Kiểm tra xem công việc đã được lưu hay chưa
        $existingFavourite = Favourite::where('user_id', $user_id)->where('job_id', $job_id)->first();

        if ($existingFavourite) {
            return response()->json(['status' => 'error', 'message' => 'Công việc đã được lưu trước đó']);
        }

        // Tạo bản ghi mới trong bảng favourites
        Favourite::create([
            'user_id' => $user_id,
            'job_id' => $job_id,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Công việc đã được lưu thành công']);
    }

    public function destroy(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Bạn cần đăng nhập để thực hiện hành động này'], 401);
        }

        $user_id = Auth::id();
        $job_id = $request->input('job_id');

        // Kiểm tra và xóa bản ghi trong favourites
        $existingFavourite = Favourite::where('user_id', $user_id)->where('job_id', $job_id)->first();

        if (!$existingFavourite) {
            return response()->json(['status' => 'error', 'message' => 'Công việc này chưa được lưu']);
        }

        $existingFavourite->delete();

        return response()->json(['status' => 'success', 'message' => 'Đã bỏ lưu công việc']);
    }

}
