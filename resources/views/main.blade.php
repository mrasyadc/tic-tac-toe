@extends('app')
@section('css')
<style>
    .table .judulTabel {
        border-top: none;
        border-bottom: none;
        color: #2F4159;
        text-align: center;
        font-weight: 400;
    }

    .container .cardTabel {
        background: #F4DFCC;
        border-radius: 15px;
        max-width: 550px;
        margin-bottom: 40px;
        margin-top: 10px;
    }


    td {
        color: #2F4159;
        font-weight: bold;
    }

    @media (max-width: 992px) {
        .container .cardTabel {
            max-width: 450px;
        }
    }

    @media (max-width: 768px) {
        .container .cardTabel {
            max-width: 370px;
        }
    }
</style>
@endsection
@section('content')
@csrf
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-10">
        <div class="card o-hidden border-0 shadow-lg my-5 py-5" style="background-color: #4097AA; border-radius: 8px;">
            <h1 class="text-center text-white">Request From Another Player</h1>
            <div class="container cardTabel">
                <table class="table">
                    <thead>
                        <tr class="row justify-content-around">
                            <th class="col-5 text-left judulTabel">Nama</th>
                            <th class="col-5 judulTabel">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="another-request">

                    </tbody>
                </table>
            </div>
            <h1 class="text-center text-white">My Own Request</h1>
            <div class="container cardTabel">
                <table class="table">
                    <thead>
                        <tr class="row justify-content-around">
                            <th class="col-11 text-left judulTabel">Nama</th>
                        </tr>
                    </thead>
                    <tbody id="own-request">

                    </tbody>
                </table>
            </div>
            <h1 class="text-center text-white">My Match</h1>
            <div class="container cardTabel">
                <table class="table">
                    <thead>
                        <tr class="row justify-content-around">
                            <th class="col-5 text-left judulTabel">Nama Lawan</th>
                            <th class="col-5 judulTabel">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="my-match">

                    </tbody>
                </table>
            </div>
            <h1 class="text-center text-white">Online User</h1>
            <div class="container cardTabel">
                <table class="table">
                    <thead>
                        <tr class="row justify-content-around">
                            <th class="col-5 text-left judulTabel">Nama</th>
                            <th class="col-5 judulTabel">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="online-user">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function getOnlineUser() {
        $.ajax({
            'url': "{{url('/get-online-user')}}",
            'method': 'GET',
            'success': function(data) {
                let html = ''
                data.forEach(element => {
                    html += `<tr><td>${element.name}</td><td><button type="button" class="btn btn-primary" onclick="sendRequest(${element.id})">Ajak bermain</button></td></tr>`
                });
                $('#online-user').html(html)
                setTimeout(() => {
                    getOnlineUser()
                }, 500);

            },
            'error': function() {
                setTimeout(() => {
                    getOnlineUser()
                }, 500);
            }
        })
    }

    function getAnotherRequest() {
        $.ajax({
            'url': "{{url('/get-another-request')}}",
            'method': 'GET',
            'success': function(data) {
                let html = ''
                data.forEach(element => {
                    html += `<tr><td>${element.from.name}</td><td><button type="button" class="btn btn-primary" onclick="acceptRequest(${element.id})">Accept Request</button></td></tr>`
                });
                $('#another-request').html(html)
                setTimeout(() => {
                    getAnotherRequest()
                }, 500);

            },
            'error': function() {
                setTimeout(() => {
                    getAnotherRequest()
                }, 500);
            }
        })
    }

    function getOwnRequest() {
        $.ajax({
            'url': "{{url('/get-own-request')}}",
            'method': 'GET',
            'success': function(data) {
                let html = ''
                data.forEach(element => {
                    html += `<tr><td>${element.to.name}</td></tr>`
                });
                $('#own-request').html(html)
                setTimeout(() => {
                    getOwnRequest()
                }, 500);

            },
            'error': function() {
                setTimeout(() => {
                    getOwnRequest()
                }, 500);
            }
        })
    }

    function getMatch() {
        let my_id = "{{$my_id}}"
        $.ajax({
            'url': "{{url('/get-match')}}",
            'method': 'GET',
            'success': function(data) {
                let html = ''
                data.forEach(element => {
                    html += `<tr><td>${element.first_player.id==my_id?element.second_player.name:element.first_player.name}</td><td><a href="{{url('game/')}}/${element.id}" type="button" class="btn btn-primary">Play</a></td></tr>`
                });
                $('#my-match').html(html)
                setTimeout(() => {
                    getMatch()
                }, 500);

            },
            'error': function() {
                setTimeout(() => {
                    getMatch()
                }, 500);
            }
        })
    }

    function sendRequest(id) {
        $.ajax({
            /* the route pointing to the post function */
            url: "{{url('/send-request')}}",
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: $('input[name="_token"]').val(),
                id: id
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                console.log("success")
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown)
                console.log(xhr)
            }
        });
    }

    function acceptRequest(id) {
        $.ajax({
            /* the route pointing to the post function */
            url: "{{url('/accept-request')}}",
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: $('input[name="_token"]').val(),
                id: id
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                console.log("success")
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown)
                console.log(xhr)
            }
        });
    }
    $(window).on('load', function() {
        getOnlineUser()
        getAnotherRequest()
        getOwnRequest()
        getMatch()
    })
</script>

@endsection