<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function listPost(){
        $listPosts = Post::where('active', true)->paginate(9);
        return view('posts.listPost',compact('listPosts'),[
            'title' => 'Danh sách bài viết'
        ]);
    }

    public function detailPost($slug)
    {
        $listPosts = Post::where('active', true)->orderByDesc("id")->take(8)->get();
        $post = Post::where('slug', $slug)->first();
        return view('posts.detailPost', compact('post','listPosts'), [
            'title' => $post->title
        ]);
    }
}
