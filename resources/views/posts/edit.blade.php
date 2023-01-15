@extends('layouts.app')

@section('content')
    <div id="colorlib-main">
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-xl-8 px-md-5">
                        <div class="row ">

                            @if(Auth::check())
                                <div class="col-md-12 border bg-white mb-4">
                                    <form class="m-3" action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="author" value="{{Auth::user()->id}}">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
                                            @error('title')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <input type="text" class="form-control" id="content" name="content" value="{{$post->content}}">
                                            @error('content')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group w-50 float-left">
                                            <label for="Photo">Photo</label>
                                            <input type="file" class="form-control-file"  name="image" id="Photo" value="{{$post->image}}">
                                            @error('image')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror

                                        </div>
                                        <button type="submit" class="btn float-end mt-4"  style="color: #e2e8f0;background-color: #4D2540">Post <span class="icon-paper-plane"></span></button>
                                    </form>
                                </div>
                                <hr class="my-12"/>
                            @endif


                        </div><!-- END-->

                    </div>
                </div>
            </div>
        </section>
    </div><!-- END COLORLIB-MAIN -->

@endsection
