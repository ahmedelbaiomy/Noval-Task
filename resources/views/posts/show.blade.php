@extends('layouts.app')

@section('content')
    <div id="colorlib-main">
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex">

                    <div class="col-lg-8 px-md-5 py-5">
                        <div class="row pt-md-4">
                            <div class="col-12 mb-5">
                                <img src="{{$post->image}}" style="width: 100%" alt="" class="img-fluid">
                            </div>
                            <h1 class="mb-3">{{$post->title}}</h1>
                            <div class="col-12"><span>{{$post->content}}</span></div>

                            <div class="pt-5 mt-5">
                                <h3 class="mb-5 font-weight-bold">{{count($post->comments)}} Comments</h3>
                                <ul class="comment-list">
                                    @foreach($post->comments as $comment)
                                        <li class="comment">


                                            <div class="vcard bio">
                                                <img src="{{asset('assets/img.png')}}" alt="Image placeholder">
                                            </div>
                                            @if(Auth::user()->id == $comment->user_id)
                                                <form method="POST" id="delete-form"
                                                      action="{{route('comments.destroy',[$comment->id])}}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn float-end"><i class="icon-times text-danger"></i></button>

                                                </form>
                                            @endif
                                            <div class="comment-body" style="width: 82%">
                                                <h3>{{$comment->user->name}}</h3>
                                                <div class="meta">{{$comment->date}}</div>
                                                <p>{{$comment->comment}}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- END comment-list -->

                                <div class="comment-form-wrap pt-5">
                                    <h3 class="mb-5">Leave a comment</h3>
                                    <div class="mb-4">
                                        <form action="{{route('comments.store')}}" method="POST" id="formComment" class="colorlib-subscribe-form">
                                            @csrf
                                            <input type="hidden" name="post_id" id="post_id"
                                                   value="{{$post->id}}">
                                            <div class="form-group d-flex"  style="position: absolute;width: 90%">
                                                <input type="text" class="form-control" name="comment"
                                                       id="comment"
                                                       placeholder="Post your thoughts {{Auth::user()->name}} ...">
                                            </div>
                                            <button type="submit" id="submitComment"
                                                    class="btn btn-circle rounded-circle"
                                                    style="color: #e2e8f0;background-color: #4D2540;position: relative;top: 7px;left: 95%;"><span
                                                    class="icon-paper-plane"></span>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div><!-- END-->
                    </div>
                    <div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
                        <div class="sidebar-box ftco-animate">
                            <h3 class="sidebar-heading">Popular Posts</h3>
                            @foreach($popularPosts as $post)
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4" style="background-image: url({{$post->image}});"></a>
                                    <div class="text">
                                        <h3 class="heading"><a href="#">{{$post->title}}</a>
                                        </h3>
                                        <div class="meta">
                                            <div><a href="#"><span class="icon-calendar"></span> {{$post->date}}</a></div>
                                            <div><a href="#"><span class="icon-person"></span> {{$post->user->name}}</a></div>
                                            <div><a href="#"><span class="icon-chat"></span> {{count($post->comments)}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- END COL -->
                </div>
            </div>
        </section>
    </div>

@endsection
