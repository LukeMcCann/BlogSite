@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title:') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content:') }}</label>

                                <div class="col-lg-6">
                                    <textarea id="content" rows="20" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" required></textarea>

                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('Category:') }}</label>

                                <div class="col-md-6">
                                    <select id="categories" type="categories" class="form-control{{ $errors->has('categories') ? ' is-invalid' : '' }}" name="categories" required>
                                        <option value="">
                                            Aerospace
                                        </option>
                                        <option value="">
                                            Astronomy
                                        </option>
                                        <option value="">
                                            Computer Science
                                        </option>
                                        <option value="">
                                            Mechanical Engineering
                                        </option>
                                        <option value="">
                                            Electrical Engineering
                                        </option>
                                        <option value="">
                                            Software Engineering
                                        </option>
                                    </select>

                                    @if ($errors->has('categories'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('categories') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="post_img" class="col-lg-4 col-form-label text-md-right">{{ __('Thumbnail:') }}</label>

                                <div class="col-lg-6">
                                    <input id="post_img" type="file" class="form-control-file{{ $errors->has('post_img') ? ' is-invalid' : '' }}" name="post_img" required>

                                    @if ($errors->has('post_img'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_img') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br  />
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
            </div>
        </div>
    </div>
@endsection
