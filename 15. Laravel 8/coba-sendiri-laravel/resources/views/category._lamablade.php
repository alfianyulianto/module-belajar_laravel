@extends('layouts.main')

@section('container')
    <h1>Halaman Category : {{ $category }}</h1>
    @forelse ($posts as $post)
        <article class="mb-5 border-bottom">
            <h2><a href="/post/{{ $post->slug }}">{{ $post->title }}</a></h2>
            <p>{{ $post->excerpt }}</p>
        </article>
    @empty
        <script>
            alert('Categories Kosong!');

            // redirect ke halaman category
            window.location.href = "http://127.0.0.1:8000/categories";
        </script>
    @endforelse
@endsection
