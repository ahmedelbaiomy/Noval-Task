<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $user=Auth::user();
        $request->merge(['user_id'=>$user->id]);

        $comment=Comment::create($request->all());
        $comment->created_by = $user->name;
        $comment->count = Comment::countcomments($comment->post_id);

        if($comment) {
            if ($request->ajax()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Posted Successfully',
                    'data' => $comment,
                ]);
            }else{
                return redirect()->back()->with(['success' => __('Posted successfully')]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {


        $comment = Comment::find($id);
        if(Auth::user()->id== $comment->user_id ){
            $comment->delete();
        }
        if($request->ajax()) {
            return response()->json([
                'success'=>true,
                'message'=>'Deleted Successfully',
            ]);
        }
        return redirect()->back()->with(['success' => __('Deleted successfully')]);

    }


}
