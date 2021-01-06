@extends('app')
@section('content')
    @foreach($users as $user)
        <img src="http://placecorgi.com/250">
        <h1>Nama:{{$user->name}}</h1>
        <h1>Email:{{$user->email}}</h1>
        <h1>Menang:{{$win}}</h1>
        <h1>Kalah:{{$lose}}</h1>
        <h1>Draw:{{$draw}}</h1>
        <h1>Jumlah Main:{{$win+$lose+$draw}}</h1>
        @if($win+$lose+$draw)
        <h1>Rata-rata menang:{{$win*100/($win+$lose+$draw)}}%</h1>
        <h1>Rata-rata kalah:{{$lose*100/($win+$lose+$draw)}}%</h1>
        <h1>Rata-rata seri:{{$draw*100/($win+$lose+$draw)}}%</h1>
        @endif
    @endforeach
@endsection
