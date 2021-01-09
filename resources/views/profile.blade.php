@extends('app')
@section('css')
<style>
    .cardStatistik {
        background: #ECF3FB;
        color: #2F4159;
        border-radius: 15px;
        margin-bottom: 40px;
        margin-top: 10px;
    }

    .cardStatistik h1 {
        font-size: 30px
    }

    .stat {
        background: #ECF3FB;
        color: #2F4159;
        border-radius: 15px;
        margin-top: 10px;
    }

    .stat h1 {
        font-size: 20px
    }
</style>
@endsection
@section('content')
@foreach($users as $user)
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5 py-5 px-5" style="background-color: #4097AA; border-radius: 8px;">
            <h1 class="text-center text-white mb-3" style="font-size: 60px;">Profile</h1>
            <div class="row justify-content-center">
                <div class="col-10 col-lg-4 text-center mb-3">
                    @if($user->gambar!=NULL)
                    <img src="{{url('/data_file/'.$user->gambar)}}" class="image-fluid" style="border-radius: 50%; width: 100%;height: auto; max-width: 200px;">
                    @else
                    <img src="/data_file/avatar.png" class="image-fluid" style="border-radius: 50%; width: 100%;height: auto; max-width: 200px;">
                    @endif

                </div>
                <div class="w-100 d-block d-lg-none"></div>
                <div class="col-10 col-lg-6 align-self-center text-center text-lg-left text-white mb-3">
                    <h1 style="font-size: 35px;">Nama: {{$user->name}}</h1>
                    <h1 style="font-size: 35px;">Email: {{$user->email}}</h1>
                    <h1 style="font-size: 35px;">Jumlah Main: {{$win+$lose+$draw}}</h1>
                    <div class="stat px-3 mt-3 pt-1">
                        <div class="row justify-content-center text-center">
                            <h1 class="col-10 col-lg-4">Menang: {{$win}}</h1>
                            <h1 class="col-10 col-lg-4">Kalah: {{$lose}}</h1>
                            <h1 class="col-10 col-lg-4">Draw: {{$draw}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cardStatistik">
                <div class="row justify-content-center text-center">
                    @if($win+$lose+$draw)
                    <h1 class="col-10 col-4">Rata-rata menang: {{$win*100/($win+$lose+$draw)}}%</h1>
                    <h1 class="col-10 col-4">Rata-rata kalah: {{$lose*100/($win+$lose+$draw)}}%</h1>
                    <h1 class="col-10 col-4">Rata-rata seri: {{$draw*100/($win+$lose+$draw)}}%</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection