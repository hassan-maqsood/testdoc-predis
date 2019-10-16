<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
	<div class="container">
{{HTML::script(env('BROADCAST_URL').'/socket.io/socket.io.js')}}

<script>

	 window.onload = function() {

            var socket = io("{{env('BROADCAST_URL')}}");

            jQuery(window).on('beforeunload', function(){
                console.log('still loading')
                socket.close();
            });

            socket.on('test-signal:App\\Events\\appAppointmentMade', function (data) {

		    console.log('signal recieved');
            });

            window.addEventListener("beforeunload", function () {
                console.log("Close web socket");
                socket.close();
            });
        };

//var sock = io("//{{ config('env.PUBLISHER_URL') }}:{{ config('env.BROADCAST_PORT') }}");
  //  sock.on('action-channel-one:App\\Events\\ActionEvent', function (data) {

        //data.actionId and data.actionData hold the data that was broadcast
        //process the data, add needed functionality here
    });
</script>
            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
        </div>
    </body>
</html>
