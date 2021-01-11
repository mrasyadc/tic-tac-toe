@extends('app')
@section('css')
<style>
    .square {
        position: relative;
        width: 25vw;
        height: 100%;
        border: 3px solid;
        border-color: #F4DFCC;
    }

    .square:after {
        content: "";
        display: block;
        padding-bottom: 100%;
    }

    h3 {
        color: white;
    }

    .content {
        position: absolute;
        width: 100%;
        height: 100%;
        text-align: center;
        color: white;
    }

    @media (min-width: 768px) {
        .content {
            font-size: 5.5rem;
        }

        .square {
            width: 10vw;
            height: 100%;
        }
    }


    @media (min-width: 992px) {
        .content {
            font-size: 5.5rem;
        }
    }

    @media (min-width: 1400px) {
        .content {
            font-size: 8rem;
        }
    }
</style>
@endsection
@section('content')
@csrf
<div class="mt-3"></div>
<div class="d-flex flex-column justify-content-center align-items-center" id="game-field">

</div>
<h3 id="giliran" style="text-align: center"></h3>
<a id="kembali" href="/" style="display: none; text-align: center"><button class="btn btn-primary">Kembali Ke Lobby</button></a>
@endsection

@section('js')
<script>
    var match_id = '{{$match_id}}'
    var my_id = '{{$my_id}}'

    function getGameField() {
        $.ajax({
            'url': "{{url('get-game-field')}}",
            'method': "GET",
            'data': {
                'id': match_id
            },
            'success': function(data) {
                $('#game-field').html(`
                <div class="d-flex flex-row">
                    <div class="square">
                        <h1 class="content" onclick="setField(1)">${data.box_1=='#'?' ':data.box_1}</h1>
                    </div>
                    <div class="square">
                        <h1 class="content" onclick="setField(2)">${data.box_2=='#'?' ':data.box_2}</h1>
                    </div>
                    <div class="square">
                        <h1 class="content" onclick="setField(3)">${data.box_3=='#'?' ':data.box_3}</h1>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="square">
                        <h1 class="content" onclick="setField(4)">${data.box_4=='#'?' ':data.box_4}</h1>
                    </div>
                    <div class="square">
                        <h1 class="content" onclick="setField(5)">${data.box_5=='#'?' ':data.box_5}</h1>
                    </div>
                    <div class="square">
                        <h1 class="content" onclick="setField(6)">${data.box_6=='#'?' ':data.box_6}</h1>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="square">
                        <h1 class="content" onclick="setField(7)">${data.box_7=='#'?' ':data.box_7}</h1>
                    </div>
                    <div class="square">
                        <h1 class="content" onclick="setField(8)">${data.box_8=='#'?' ':data.box_8}</h1>
                    </div>
                    <div class="square">
                        <h1 class="content" onclick="setField(9)">${data.box_9=='#'?' ':data.box_9}</h1>
                    </div>
                </div>
                `)
                if (data.status === 'finish') {
                    if (data.winner == my_id) {
                        $('#giliran').html(`Selamat Anda Menang`)
                    } else if (data.winner == null) {
                        $('#giliran').html(`Permainan Berakhir Seri`)
                    } else {
                        $('#giliran').html(`Anda Kalah`)
                    }
                    document.getElementById('kembali').style.display = 'block';
                } else {
                    $('#giliran').html(`Giliran ${data.turn==1?data.first_player.name:data.second_player.name}`)
                    setTimeout(() => {
                        getGameField()
                    }, 500);
                }
            },
            'error': function() {
                setTimeout(() => {
                    getGameField()
                }, 500);
            }
        })
    }

    function setField(field_no) {
        $.ajax({
            /* the route pointing to the post function */
            url: "{{url('/set-field')}}",
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: $('input[name="_token"]').val(),
                match_id: match_id,
                field_no: field_no
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                console.log("success")
                console.log(data);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown)
                console.log(xhr)
            }
        });
    }
    $(window).on('load', function() {
        getGameField()
    })
</script>
@endsection
