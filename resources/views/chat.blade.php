<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Real Time Chat</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                /*font-family: 'Raleway', sans-serif;*/
                /*font-weight: 100;*/
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .list-group{
                height: 300px;
                overflow-y:auto;
            }
            .list-group-item{
                max-width: 100%;
                word-break: break-all;
            }
            .chat-layout{
            position: absolute;
            right: 0;
            bottom: 0;
            width: 30rem;
            border: 1px solid #ccc;
            padding: 10px;
            z-index: 4;
            background: #fbf5f5;
            }
            [v-cloak] > * { display:none; }
            [v-cloak]::before { content: "loading..."; }
        </style>
    </head>
    <body>
        <div class="row">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="container">
                <div class="row" id="app" >
                    <div class="panel panel-body" style="margin: 0px auto;
    width: 40%;">
                      <h1></h1>
                      <div class="chat-layout" v-cloak>
                        <li class="list-group-item active">Lists <span class="badge badge-pill badge-danger">@{{ noOfUsers }}</span>
                        <span class="badge badge-pill badge-secondary pull-right">@{{ typing }}</span>
                        <a href='' class="btn btn-sm btn-warning" style="float:right;" @click.prevent="deleteSession">Clear</a>
                        </li>
                        
                          <ul class="list-group" id="chat_ul" vue-chat-scroll>
                    
                            <message v-for="value,index in chat.message" :key="value.index" :color=chat.color[index] :user=chat.user[index] :time=chat.time[index]>
                                    @{{ value }}
                                </message>
                             
                            </ul>

                              <input type="text" name="chat-msg-txt" @keyup.enter='send' :click="send" v-model="message" class="form-control"/>
                             
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <script type="text/javascript">
            
        //     window.onload = function(e) {
        //     function gotoBottom(id){
        //         var div = document.getElementById(id);
        //         div.scrollTop = div.scrollHeight - div.clientHeight;
        //     }
        //     gotoBottom('chat_ul');

        //     };

        //     window.setInterval(function(){
        //      var div = document.getElementById('chat_ul');
        //         div.scrollTop = div.scrollHeight - div.clientHeight;
        // }, 1000);
        </script>
    </body>
</html>
