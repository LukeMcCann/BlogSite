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
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-4">
                        <div class="col-md-8">
                            <img src="{{$profile->profile_img}}" class="avatar" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
