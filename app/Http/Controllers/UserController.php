<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('profile.profile',compact('user'),[
            'title' => 'Cập nhật thông tin'
        ]);
    }

    public function updateProfile(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'phone_number' => 'nullable|string|max:15',
        ]);

        // Lấy người dùng hiện tại
        $user = User::find(Auth::user()->id);

        // Cập nhật thông tin người dùng
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'];

        // Xử lý ảnh đại diện nếu có
        $thumb = $request->file('thumb'); // Lấy file ảnh từ file Upload
        if ($thumb) {
            $fileName = Str::slug($user->name) . '.jpg'; // Tên ảnh theo Slug Title
//                $avatar->storeAs('public/images/avatars', $fileName); // Lưu ảnh đã thêm vào đường dẫn này
            $thumb->move(public_path('temp/images/avatar'), $fileName); // Di chuyển ảnh vào thư mục này

            $user->thumb = $fileName; // Lưu tên file ảnh theo slug Title
        }

        // Lưu thông tin người dùng đã cập nhật
        $user->save();

        // Trả về thông báo thành công
        return redirect()->route('profile')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function changePassword()
    {
        return view('profile.change_password',[
            'title' => 'Đổi mật khẩu'
        ]);
    }

    // Cập nhật mật khẩu

public function updatePassword(Request $request)
{
    // Kiểm tra mật khẩu hiện tại
    if (empty($request->current_password)) {
        return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không được để trống.']);
    }

    // Kiểm tra mật khẩu hiện tại có đúng không
    $user = User::find(Auth::user()->id);
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Mật khẩu hiện tại chưa nhập đúng.']);
    }

    // Kiểm tra mật khẩu mới
    if (empty($request->new_password)) {
        return back()->withErrors(['new_password' => 'Mật khẩu mới không được để trống.']);
    }

    if (strlen($request->new_password) < 8) {
        return back()->withErrors(['new_password' => 'Mật khẩu mới phải có ít nhất 8 ký tự.']);
    }

    // Kiểm tra mật khẩu xác nhận (confirmed)
    if ($request->new_password !== $request->new_password_confirmation) {
        return back()->withErrors(['new_password_confirmation' => 'Mật khẩu nhập lại không khớp.']);
    }

    // Cập nhật mật khẩu
    $user->password = Hash::make($request->new_password);
    $user->save();

    // Trả về thông báo thành công
    return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật thành công!');
}

}
