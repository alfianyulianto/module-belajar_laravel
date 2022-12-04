@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $posts->title }}</h1>
                <p>By. <a href="/posts?author={{ $posts->author->username }}"
                        class="text-decoration-none">{{ $posts->author->name }}</a>
                    in
                    <a href="/posts?category={{ $posts->category->slug }}"
                        class="text-decoration-none">{{ $posts->category->name }}</a>
                </p>
                @if ($posts->images)
                    <div style="max-height:400px; overflow:hidden">
                        <img src="{{ asset('storage/' . $posts->images) }}" alt="{{ $posts->category->name }}"
                            class="img-fluid mt-3">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $posts->category->name }}"
                        alt="{{ $posts->category->name }}" class="img-fluid">
                @endif


                <p>{!! $posts->body !!}</p>

                <a href="/posts" class="text-decoration-none">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection
