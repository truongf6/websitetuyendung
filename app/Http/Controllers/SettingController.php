<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $money = setting::where('key','money')->first();
        return view('admin.setting.index',compact('money'),[
            'title' => 'Thiết lập'  
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'money' => 'required|numeric|min:0',
        ]);

        // Tìm bản ghi thiết lập với key là 'money'
        $setting = Setting::where('key', 'money')->first();

        if (!$setting) {
            // Nếu không tồn tại, tạo mới
            $setting = new Setting();
            $setting->key = 'money';
        }

        // Cập nhật giá trị
        $setting->value = $request->input('money');
        $setting->save();

        // Chuyển hướng về trang thiết lập với thông báo thành công
        return redirect()->route('settings.index')->with('success', 'Cập nhật phí đăng bài tuyển dụng thành công!');
    }

}
