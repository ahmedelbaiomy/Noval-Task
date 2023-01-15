<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['comments.user', 'user'])->orderBy('id', 'DESC')->get();
        $popularPosts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        if (session('success')) {
            toast(session('success'), 'success');
        } else if (session('error')) {
            toast(session('error'), 'error');
        }
        return view('posts.index', compact('posts','popularPosts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        $post = Post::create($request->except('image'));
        $fileName = '';
        if ($request->has('image')) {
            $fileName = uploadImage('posts', $request->image);
        }
        $post->image = $fileName;
        $post->save();
        DB::commit();
        return redirect()->back()->withSuccess('Posted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $popularPosts = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();

        if (session('success')) {
            toast(session('success'), 'success');
        } else if (session('error')) {
            toast(session('error'), 'error');
        }
        $post = Post::find($id)->with('comments.user')->first();
        return view('posts.show', compact('post','popularPosts'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        DB::beginTransaction();
        $post = Post::find($id);
        $post->update($request->except('image'));
        $fileName = '';
        if ($request->has('image')) {
            $fileName = uploadImage('posts', $request->image);
            $post->image = $fileName;
            $post->save();
        }
        DB::commit();
        return redirect()->route('posts.index')->withSuccess('Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id',$id)->get();
        if (!$post) {
            return redirect()->back()->with(['error' => __('post not found')]);
        } else {

            //soft delete
            DB::beginTransaction();
            $post->delete();
            if($comments){
                foreach ($comments as $comment){
                    $comment->delete();
                }

            }
            DB::commit();

            //force delete
//            $fileName = explode("/",$post->image)[6];
//            $folder = explode("/",$post->image)[5];
//
//            DB::beginTransaction();
//            if (File::exists(public_path('/assets/images/'.$folder.'/'.$fileName))) {
//                File::delete(public_path('/assets/images/'.$folder.'/'.$fileName));
//            }
//            $post->delete();
//            DB::commit();
            return redirect()->back()->with(['success' => __('Deleted successfully')]);
        }
    }
}
