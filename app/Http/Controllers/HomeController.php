<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
//    public function index()
//    {
//        $posts = Post::all();
//
//        if(session('success')){
//            toast(session('success'),'success');
//        }else if(session('error')){
//            toast(session('error'),'error');
//        }
//        return view('home',compact('posts'));
//    }
}
