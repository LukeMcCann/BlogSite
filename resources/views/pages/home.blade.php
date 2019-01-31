@extends('layouts.app')
<style type="text/css">

    body {
        font-family: sans-serif;
    }

    .avatar {
        border-radius: 100%;
        max-width: 200px;
    }

    img {
        max-width: 250px;
        border: 5px solid black;
        box-shadow: box-shadow: 5px 10px #888888;
    }

    .col-centered {
        float: none;
        margin: 0 auto;
        text-align: center;
    }

</style>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(count($errors) > 0)
                @foreach($erorrs->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            @if(session('response'))
                <div class="alert alert-success">
                    {{session('response')}}
                </div>
            @endif
            <div class="card">
                @if(!empty($profile))
                    <div class="card-header text-center bg-dark text-white">{{$profile->username . "'s Dashboard"}}</div>
                @else
                    <div class="card-header">Dashboard</div>
                @endif

                <div class="card-body text-center bg-dark text-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row container-fluid">
                        {{-- <div class="col-md-7"> --}}
                        <div class="col-md-4 col-centered">
                            @if(!empty($profile))
                                <img src="{{$profile->profile_img}}" class="avatar" alt="avatar_image" />
                                <p class="lead">
                                    {{$profile->username}}
                                </p>
                                <p>
                                    {{$profile->title}}
                                </p>
                            @else
                                <img src="{{url('images/avatar.jpg')}}" class="avatar" alt="avatar_image" />
                                <p></p>
                                <p></p>
                            @endif
                        </div>
                        <div class="col-md-8 col-centered">
                            @if(count($posts) > 0)
                                @foreach($posts->all() as $post)
                                    <h4>
                                        {{$post->post_title}}
                                    </h4>

                                    <img src="{{$post->post_img}}" alt="post_image"/>
                                    <br />
                                    <p>
                                        {{substr($post->post_content, 0, 400) . "..."}}
                                    </p>
                                    <ul class="nav nav-pills">
                                        <li role="presentation">
                                                {{-- <a style="color: blue;" role="button" class=" btn btn-light fa fa-eye"> view</a> --}}
                                                <a href='{{ url("/view/{$post->id}") }}' style="color: white;" role="button" class="btn btn-dark fa fa-eye">view</a>
                                        </li>
                                        <li role="presentation">
                                                <a href='{{ url("/edit/{$post->id}") }}'style="color: white;" role="button" class=" btn btn-dark fas fa-edit"> edit</a>
                                        </li>
                                        <li role="presentation">
                                                <a href='{{ url("/delete/{$post->id}") }}' style="color: white;" role="button" class="btn btn-dark fas fa-trash-alt"> delete</a>
                                        </li>
                                    </ul>
                                    <cite style="float: left;">Posted on: {{date('M d, Y H:m', strtotime($post->created_at))}}</cite>
                                    <br />
                                    <hr />
                                @endforeach
                            @else
                                <p>
                                    Post Unavailable!
                                </p>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
