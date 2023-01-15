@extends('layouts.app')

@section('content')
    @if(!Auth::check())
    <div id="top-alert" class="alert alert-danger text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <span class=""><strong>Sorry, </strong>You must log in first so that you can post and share your ideas</span>
    </div>
    @endif
    <div id="colorlib-main">
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-xl-8 px-md-5">
                        <div class="row ">


                            @if(Auth::check())
                                <div class="col-md-12 border bg-white mb-4">
                                    <form class="m-3" action="{{route('posts.store')}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="author" value="{{Auth::user()->id}}">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                   placeholder="Enter Title">
                                            @error('title')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <input type="text" class="form-control" id="content" name="content"
                                                   placeholder="Post your thoughts {{Auth::user()->name}} ...">
                                            @error('content')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group w-50 float-left">
                                            <label for="Photo">Photo</label>
                                            <input type="file" class="form-control-file" name="image" id="Photo">
                                            @error('image')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror

                                        </div>
                                        <button type="submit" class="btn float-end mt-4"
                                                style="color: #e2e8f0;background-color: #4D2540">Post <span
                                                class="icon-paper-plane"></span></button>
                                    </form>
                                </div>
                                <hr class="my-12"/>
                            @endif
                            <div class="col-md-12 mt-5">
                                @foreach($posts as $post)
                                    <div class="blog-entry ftco-animate d-md-flex">
                                        <a href="{{route('posts.show',$post->id)}}" class="img img-2"
                                           style="background-image: url({{$post->image}});"></a>
                                        <div class="text text-2 pl-md-4">
                                            @if(Auth::check())
                                                @if(Auth::user()->id == $post->author)
                                                    <div class="dropdown show float-end">
                                                        <a class="btn btn-secondary dropdown-toggle" href="#"
                                                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-settings"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                               href="{{route('posts.edit',$post->id)}}">Edit</a>

                                                            {{--                                                                <a class="dropdown-item text-danger" href="{{route('posts.destroy',[$post->id])}}">Delete</a>--}}
                                                            <form method="POST" id="delete-form"
                                                                  action="{{route('posts.destroy',[$post->id])}}">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button class="dropdown-item text-danger"> delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <h3 class="mb-2"><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></h3>

                                            <div class="meta-wrap">
                                                <p class="meta">
                                                    <span><i class="icon-calendar mr-2"></i>{{$post->date}}</span>
                                                    <span><a href="{{route('posts.show',$post->id)}}" class="commentCounter"><i class="icon-comment2 mr-2"></i>{{count($post->comments)}} Comment</a></span>
                                                </p>
                                            </div>
                                            <p class="mb-4">{{$post->content}}</p>
                                            @if(Auth::check())
                                                <div class="comments_body">

                                                </div>

                                                <div class="mb-4">
                                                    <form id="formComment" class="colorlib-subscribe-form">
                                                        @csrf
                                                        <input type="hidden" name="post_id" id="post_id"
                                                               value="{{$post->id}}">
                                                        <div class="form-group d-flex" style="position: absolute;width: 100%">
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
                                            @endif
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div><!-- END-->

                    </div>
                    @if(Auth::check())
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
                    @endif
                </div>
            </div>
        </section>
    </div><!-- END COLORLIB-MAIN -->

@endsection

@section('script')
    <script>
        window.removeComment = (function (id) {
            var url = "{{route('comments.destroy',":id")}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "delete",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (res) {

                    if (res.success == true) {
                        window.location.reload();
                    }
                }
            });

        });

        $('#formComment').on('submit', function (e) {
            e.preventDefault();
            var user_id = $('#user_id').val();
            var comment = $('#comment').val();
            var post_id = $('#post_id').val();
            var _token = $('input[name="_token"]', $('#formComment')).val();

            $.ajax({
                type: "POST",
                url: "{{route('comments.store')}}",
                data: {
                    _token: _token,
                    user_id: user_id,
                    comment: comment,
                    post_id: post_id,
                },
                success: function (res) {

                    if (res.success == true) {

                        var comment = res.data;
                        var html = '';
                        html += '<div class="mb-4 pl-2" style="border-left: 3px solid #4D2540;">';
                        html += '<button class="btn delete float-end" type="button" onclick="removeComment(' + comment['id'] + ')"><i class="icon-times text-danger"></i></button>';
                        html += '<h5 class="mb-2"><a href="#">' + comment['created_by'] + '</a></h5>';
                        html += '<p class="mb-4">' + comment['comment'] + '</p>';
                        html += '</div>';

                        $('.comments_body').append(html);
                        $('.commentCounter').html('<i class="icon-comment2 mr-2"></i>'+comment['count']+'Comment');

                    }
                }
            });
        });


    </script>
@endsection
