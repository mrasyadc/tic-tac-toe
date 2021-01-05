@extends('app')
@section('content')
{{--    @foreach($user as $u)--}}
{{--        <h1>Foto:{{$u->id}}</h1>--}}
{{--        <h1>Password:{{$u->email}}</h1>--}}
{{--    @endforeach--}}
@foreach($user as $u)
    <form action="/edit/proses" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $u->id }}"> <br/>
        Nama <input type="text" required="required" name="name" value="{{ $u->name }}"> <br/>
        Password Lama <input type="password" required="required" name="oldPassword"> <br/>
        Password Baru <input type="password" required="required" name="newPassword"> <br/>
        <input type="submit" value="Simpan Data">
        <a href="..">
            <button>Batalkan</button></a>
    </form>
@endforeach
@endsection
