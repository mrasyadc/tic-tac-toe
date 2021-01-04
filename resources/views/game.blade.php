@extends('app')
@section('css')
<style>
    .square {
        position:relative;
        width: 10vw;
        border:1px solid black;
    }

    .square:after {
    content: "";
    display: block;
    padding-bottom: 100%;
    }
    .content {
    position: absolute;
    width: 100%;
    height: 100%;
    text-align:center;
    font-size:10rem;
    
    }
</style>
@endsection
@section('content')
@csrf
<div class="d-flex flex-column" id="game-field">
    
</div>
<h3 id="giliran"></h3>
@endsection

@section('js')
<script>
    var match_id = '{{$match_id}}'
    var my_id = '{{$my_id}}'
    function getGameField(){
        $.ajax({
            'url':"{{url('get-game-field')}}",
            'method':"GET",
            'data':{
                'id':match_id
            },
            'success':function(data){
                
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
                $('#giliran').html(`Giliran ${data.turn==1?data.first_player.name:data.second_player.name}`)
                setTimeout(() => {
                    getGameField()
                }, 500);
            },
            'error':function(){
                setTimeout(() => {
                    getGameField()
                }, 500);
            }
        })
    }
    function setField(field_no){
        $.ajax({
                    /* the route pointing to the post function */
                    url: "{{url('/set-field')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: $('input[name="_token"]').val(), match_id:match_id,field_no:field_no},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                        console.log("success")
                    },
                    error:function(xhr, textStatus, errorThrown){
                        console.log(errorThrown)
                        console.log(xhr)
                    }
                }); 
    }
    $(window).on('load',function(){
        getGameField()
    })
</script>
@endsection