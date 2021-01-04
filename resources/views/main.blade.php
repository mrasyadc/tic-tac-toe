
@extends('app')
@section('content')
@csrf
        <h1>Request from another player</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="another-request">
                
            </tbody>
        </table>
        <h1>My own request</h1>
          <table class="table">
              <thead>
                  <tr>
                      <th>Nama</th>
                  </tr>
              </thead>
              <tbody id="own-request">
                  
              </tbody>
          </table>
          <h1>My Match</h1>
          <table class="table">
              <thead>
                  <tr>
                      <th>Nama Lawan</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody id="my-match">
                  
              </tbody>
          </table>
          <h1>Online User</h1>
          <table class="table">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody id="online-user">
                  
              </tbody>
          </table>
      
          @endsection
    @section('js')
    <script>
        function getOnlineUser(){
            $.ajax({
                'url':"{{url('/get-online-user')}}",
                'method':'GET',
                'success':function(data){
                    let html=''
                    data.forEach(element => {
                        html+=`<tr><td>${element.name}</td><td><button type="button" class="btn btn-primary" onclick="sendRequest(${element.id})">Ajak bermain</button></td></tr>`
                    });
                    $('#online-user').html(html)
                    setTimeout(() => {
                        getOnlineUser()
                    }, 500);
                    
                },
                'error':function(){
                    setTimeout(() => {
                        getOnlineUser()
                    }, 500);
                }
            })
        }

        function getAnotherRequest(){
            $.ajax({
                'url':"{{url('/get-another-request')}}",
                'method':'GET',
                'success':function(data){
                    let html=''
                    data.forEach(element => {
                        html+=`<tr><td>${element.from.name}</td><td><button type="button" class="btn btn-primary" onclick="acceptRequest(${element.id})">Accept Request</button></td></tr>`
                    });
                    $('#another-request').html(html)
                    setTimeout(() => {
                        getAnotherRequest()
                    }, 500);
                    
                },
                'error':function(){
                    setTimeout(() => {
                        getAnotherRequest()
                    }, 500);
                }
            })
        }
        function getOwnRequest(){
            $.ajax({
                'url':"{{url('/get-own-request')}}",
                'method':'GET',
                'success':function(data){
                    let html=''
                    data.forEach(element => {
                        html+=`<tr><td>${element.to.name}</td></tr>`
                    });
                    $('#own-request').html(html)
                    setTimeout(() => {
                        getOwnRequest()
                    }, 500);
                    
                },
                'error':function(){
                    setTimeout(() => {
                        getOwnRequest()
                    }, 500);
                }
            })
        }
        function getMatch(){
            let my_id ="{{$my_id}}"
            $.ajax({
                'url':"{{url('/get-match')}}",
                'method':'GET',
                'success':function(data){
                    let html=''
                    data.forEach(element => {
                        html+=`<tr><td>${element.first_player.id==my_id?element.second_player.name:element.first_player.name}</td><td><a href="{{url('game/')}}/${element.id}" type="button" class="btn btn-primary">Play</a></td></tr>`
                    });
                    $('#my-match').html(html)
                    setTimeout(() => {
                        getMatch()
                    }, 500);
                    
                },
                'error':function(){
                    setTimeout(() => {
                        getMatch()
                    }, 500);
                }
            })
        }
        function sendRequest(id){
            $.ajax({
                    /* the route pointing to the post function */
                    url: "{{url('/send-request')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: $('input[name="_token"]').val(), id:id},
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

        function acceptRequest(id){
            $.ajax({
                    /* the route pointing to the post function */
                    url: "{{url('/accept-request')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: $('input[name="_token"]').val(), id:id},
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
            getOnlineUser()
            getAnotherRequest()
            getOwnRequest()
            getMatch()
        })
    </script>
  
  @endsection