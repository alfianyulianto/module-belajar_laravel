@extends('layouts.main')

@section('container')
    <h1>Halaman About</h1>
    <br>
    <h2>{{ $datas['name'] }}</h2>
    <h2>{{ $datas['email'] }}</h2>
    <img src="img/{{ $datas['images'] }}" alt="">
@endsection
