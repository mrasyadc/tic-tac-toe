@extends('app')
@section('content')
    @foreach($users as $user)
        <h1>Nama:{{$user->name}}</h1>
        <h1>Email:{{$user->email}}</h1>
        <h1>Menang:{{$win}}</h1>
        <h1>Kalah:{{$lose}}</h1>
        <h1>Draw:{{$draw}}</h1>
        jumlah main, jumlah menang,
        jumlah kalah, jumlah seri, rasio menang-kalah-seri, rata-rata
        menang, rata-rata kalah, rata-rata seri,

    @endforeach
{{--    <a href="/logout"><button>Logout</button></a>--}}
@endsection
