<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')ChannelNest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/app.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/img/logo.png" height="30" width="30" alt="ChannelNest"/>&nbsp;ChannelNest
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('videoSubmit') }}">Submit</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Log in</a></li>
                @else
                    {{--                <li><a href="{{ route('account_profile', ['user' => $user]) }}">{{ $user->username }}</a></li>--}}
                    <li><a href="{{ route('profile', ['id' => \Auth::user()->id, 'username' => \Auth::user()->slug()]) }}">{{ \Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                            out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">{{ csrf_token() }}
                        </form>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @isset($messages)
        @foreach($messages as $message)
            <div class="alert alert-{{ $message->tags }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{ $message->message }}
            </div>
        @endforeach
    @endisset
    @yield('content')
    <hr>
    <footer>
        <p>&copy;&nbsp;{{ date('Y') }} ChannelNest.com, All rights reserved.</p>
        <p>This website is not related, authorized, approved or associated with Nest.com or Nest products.</p>
    </footer>
</div>
@stack('inlinescripts')
</body>
</html>
