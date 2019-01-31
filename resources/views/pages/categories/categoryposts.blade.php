@extends('layouts.app')
<style>
    img {
        max-width: 250px;
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
            <div class="card">
                <div class="card-header text-center bg-dark text-white">{{ __('View') }}</div>


                <div class="col-md-8 col-centered">
                    @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                            <h4>
                                {{$post->post_title}}
                            </h4>

                            <img src="{{$post->post_img}}" alt="post_image"/>
                            <br />
                            <p>
                                {{$post->post_content}}
                            </p>


                        @endforeach
                    @else
                        <p>
                            Post Unavailable! Please select a different category!
                        </p>
                  @endif
                </div>

                <div class="card-body col-md-20">
                    <ul class="list-group text-center">
                        @if(count($categories) > 0)
                            @foreach($categories->all() as $category)
                                    <li class="list-group-item">
                                        <a href="{{ url("category/{$category->id}") }}">{{$category->category}}</a>
                                    </li>
                            @endforeach
                        @else
                            <p>
                                Category does not exist.
                            </p>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
