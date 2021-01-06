@extends('app')
@section('css')
<style>
    .tulisanEdit {
        color: #2F4159;
        font-weight: bold;
    }

    .tombol {
        max-width: 380px;
        display: inline;
    }

    .tombolBatal {
        max-width: 380px;
        background-color: #FFC3B8;
        border: #FFC3B8;
        display: inline;
        color: #2F4159;
    }

    .tombolBatal:hover {
        background-color: #E3A89E;
    }
</style>
@endsection
@section('content')
{{-- @foreach($user as $u)--}}
{{-- <h1>Foto:{{$u->id}}</h1>--}}
{{-- <h1>Password:{{$u->email}}</h1>--}}
{{-- @endforeach--}}
@foreach($user as $u)
<!-- Ganti password -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #4097AA; border-radius: 8px;">
            <div class="row">
                <div class="col">
                    <div class="p-5">
                        <h1 class="text-center text-white mb-3" style="font-size: 60px;">Edit Your Account</h1>
                        <form action="/edit/proses" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $u->id }}">
                            <br />
                            <div class="form-group tulisanEdit">
                                Nama <input class="form-control form-control-user" type="text" required="required" name="name" value="{{ $u->name }}" />
                            </div>
                            <br />
                            <div class="form-group tulisanEdit">
                                Password Lama <input class="form-control form-control-user" type="password" required="required" name="oldPassword" placeholder="Masukkan Password lama..." />
                            </div>
                            <br />
                            <div class="form-group tulisanEdit">
                                Password Baru <input class="form-control form-control-user" id="newPassword" type="password" required="required" name="newPassword" placeholder="Masukkan Password baru..." onkeyup="check()" />
                            </div>
                            <br />
                            <div class="form-group tulisanEdit">
                                Retype Password Baru <input class="form-control form-control-user" id="newPasswordRetyped" type="password" required="required" name="newPasswordRetyped" placeholder="Retype Password baru..." onkeyup="check()" />
                            </div>
                            <br />
                            <div class="text-center mb-3">
                                <input class="btn btn-primary btn-user btn-block tombol" type="submit" value="Simpan Data">
                                <a href=".."><button class="btn btn-primary btn-user btn-block tombolBatal">Batalkan</button></a>
                            </div>
                        </form>
                        <div id="alert"></div>
                        @if($errors->any())
                        <div class="alert alert-danger">{{$errors->first()}}</div>
                        @endif

                        <!-- Ganti Poto -->
                        <br />
                        <h1 class="text-center text-white mb-3 mt-3" style="font-size: 60px;">Edit Profile Photo</h1>
                        <form action="/edit/gambar" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="file" /><br />
                            <div class="text-center my-3">
                                <input class="btn btn-primary btn-user btn-block tombol" type="submit" value="Upload" />
                        </form>
                        <a href="/profile"><button class="btn btn-primary btn-user btn-block tombolBatal">Batalkan</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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