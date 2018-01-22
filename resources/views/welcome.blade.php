<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Imperial Commercials Holiday Planner</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                color: #fff;
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
                color: #bbb;
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
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="shortcut icon" href="/img/favicon.png">
    </head>
    <body>
        <div class="container-full welcome-page clearfix">
            <div class="halfwide  d-inline-block">
                <div class="title m-b-md">
                    <img class="welcome-page-logo" src="/img/logo.png">
                    <h1>
                        Holiday Planner
                        <sup>
                            <small class="danger">BETA</small>
                        </sup>
                    </h1>
                    <h4>Imperial Commercials</h4>
                </div>
            </div>
            <div class="halfwide  d-inline-block" style="float:right;">
                <div class="flex-center position-ref full-height">
                    {{--
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @if (Auth::check())
    
                                    <a href="{{ url('/home') }}">Home</a>
                                @else
                                    <a href="{{ url('/login') }}">Login</a>
                                    {{- - <a href="{{ url('/register') }}">Register</a> - -}}
                                @endif
                            </div>
                        @endif
                    --}}
                    <div class="content">
                        <div class="panel panel-default-welcome">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                            <label for="username" class="col-md-4 control-label">Username</label>

                                            <div class="col-md-6">
                                                <input id="username" type="text" class="welcomeInput form-control " name="username" value="{{ old('username') }}" required autofocus>

                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                             <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-info">
                                                    Login
                                                </button>

                                                {{-- <a class="btn btn-default" href="{{ route('password.request') }}">
                                                    Forgot Your Password?
                                                </a> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <div class="links">
                            <a href="https://www.imperialcommercials.co.uk/">Imperial</a>
                            <a href="https://www.sbcommercials.co.uk/">SB Commercials</a>
                            <a href="http://www.orwelltruckandvan.co.uk/">Orwell</a>
                            <a href="http://www.ttequip.co.uk/">TruckTrailerEquip</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
