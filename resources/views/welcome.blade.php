<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Minha Loja</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
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
    </style>
</head>
<body>
<img src="{{asset('storage/images/brands/giphy.gif')}}" style="width: 100%; height:100% ;position: fixed; padding-left: 0px; ">
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Página Inicial</a>
            @else
                <a href="{{ route('login') }}">Login</a> |
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md" style="font-size: 200px;">
            {{--<img width="700px" src="{{asset('storage/images/brands/logo4.png')}}">--}}
            <p style="  color: #ffcc00;
                font-family: Impact, Charcoal, sans-serif;
                 text-shadow: #0f0f0f 1px 3px;
            ">MINHA LOJA</p>
        </div>
    </div>
</div>
</body>
</html>
