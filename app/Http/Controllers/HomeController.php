<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use App\Models\Company;
use App\Models\Application;
use App\Models\Job_Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $Jobs = Job::Where('Hide','!=',true)->orWhereNull('Hide')->orderByDesc("created_at")->take(6)->get();
        $count_job = Job::count();
        $count_employee= User::where('role_id',3)->count();
        $company= Company::count();
        $applied= Application::count();
        $company_hads = Company::orderByDesc('id')->take(6)->get();
        $listPosts = Post::where('active', true)->paginate(20);
        $categories = Job_Category::all();

        return view('home',compact('Jobs','count_job','count_employee','company_hads','applied','company','listPosts','categories'),[
            'title' => 'Trang chủ'
        ]);
    }

}
