<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use ValidatesRequests;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\Application;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about(){
        $count_job = Job::count();
        $count_employee= User::where('role_id',3)->count();
        $company= Company::count();
        $applied= Application::count();
        return view('pages.about',compact('count_job','count_employee','company','applied'),[
            'title' => 'Giới thiệu'
        ]);
    }

    public function contact(){ 
        return view('pages.contact',[
            'title' => 'Liên hệ'
        ]);
    }

    public function postContact(Request $request){
        $feedback = new Feedback;
        $feedback->fullname = $request->fullname;
        $feedback->phone_number = $request->phone_number;
        $feedback->email = $request->email;
        $feedback->title = $request->title;
        $feedback->contents = $request->contents;
        $feedback->save();
        return redirect()->back()->with('success', 'Gửi phản hồi thành công!');
    }
}
