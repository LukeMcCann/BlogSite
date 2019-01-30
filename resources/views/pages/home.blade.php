@extends('layouts.app')
<style type="text/css">
    .avatar {
        border-radius: 100%;
        max-width: 100px;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <div class="card-header">{{$profile->username . "'s Dashboard"}}</div>
                @else
                    <div class="card-header">Dashboard</div>
                @endif


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-4">
                        <div class="col-md-8">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
