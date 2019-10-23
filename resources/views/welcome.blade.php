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

        <script src="{{env('BROADCAST_URL').'/socket.io/socket.io.js'}}"></script>

        <script>
	        window.onload = function() {

            var socket = io("{{env('BROADCAST_URL')}}");

            jQuery(window).on('beforeunload', function(){
                console.log('still loading')
                socket.close();
            });

            socket.on('test-signal:App\\Events\\SomeEvent', function (data) {

		    console.log('signal received');
            });

            window.addEventListener("beforeunload", function () {
                console.log("Close web socket");
                socket.close();
            });
        };
        </script>

            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
        </div>
    </body>
</html>
