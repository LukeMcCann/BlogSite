@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
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
                    <div class="card-header">{{ __('New-Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/newProfile') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('UserName:') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title:') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="input" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" required>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profile_img" class="col-lg-4 col-form-label text-md-right">{{ __('Profile Picture:') }}</label>

                                <div class="col-lg-6">
                                    <input id="profile_img" type="file" class="form-control-file{{ $errors->has('profile_img') ? ' is-invalid' : '' }}" name="profile_img" required>

                                    @if ($errors->has('profile_img'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('profile_img') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
