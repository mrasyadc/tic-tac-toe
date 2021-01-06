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
        Nama <input type="text" required="required" name="name" value="{{ $u->name }}" /> <br/>
        Password Lama <input type="password" required="required" name="oldPassword" /> <br/>
        Password Baru <input id="newPassword" type="password" required="required" name="newPassword" onkeyup="check()"/> <br/>
        Retype Password Baru <input id="newPasswordRetyped" type="password" required="required" name="newPasswordRetyped" onkeyup="check()"/> <br/>
        <input type="submit" value="Simpan Data">
        <a href=".."><button>Batalkan</button></a>
    </form>
    <div id="alert"></div>
    @if($errors->any())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    <br/>
    <form action="/edit/gambar" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="file"/><br/>
        <input type="submit" value="Upload"/>
    </form>
    <a href="/profile"><button>Batalkan</button></a>
@endforeach
@endsection
@section('js')
    <script>
    var check = function() {
        if (document.getElementById('newPassword').value ===
            document.getElementById('newPasswordRetyped').value) {
                document.getElementById('alert').className = 'alert alert-success';
                document.getElementById('alert').innerHTML = 'Your Password Match';
        } else {
            document.getElementById('alert').className = 'alert alert-danger';
            document.getElementById('alert').innerHTML = 'Your Password Not Match';
        }
    }
    </script>
@endsection
