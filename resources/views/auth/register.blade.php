@extends('auth.template')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #4097AA; border-radius: 8px;">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-white font-weight-bolder mb-4" style="font-size: 2.5rem;">Register Your Account!</h1>
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('type')}}" role="alert">
                                <strong>{{Session::get('message')}}</strong>
                            </div>
                            @endif
                            <form class="user" method="POST" action="{{url('/register')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="name" placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bolder" style="background-color: #FFC3B8; font-size: 20px; color: #2F4159; border-color: #FFC3B8;">
                                    Register
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small text-white" href="{{url('/login')}}">Back to login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection