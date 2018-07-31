<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Social') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-light navbar-laravel" style="background-color: rgba(227, 242, 253, 0.5);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse " id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <form method="get" action="{{ url('/search') }}" class="form-inline my-2 my-lg-0">
                        <input name="q" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <ul class="navbar-nav mr-auto ">
                        @if(Auth::check())
                        <li class="ml-sm-4">
                            @if(Auth::user()->avatar && strpos(Auth::user()->avatar, 'randomuser') == false)
                            <img src="{{ asset('storage/users/' . Auth::user()->id . '/avatars/' . Auth::user()->avatar) }}" alt="User Avatar" class="rounded-circle" width="40">
                            @elseif(Auth::user()->avatar && strpos(Auth::user()->avatar, 'randomuser') == true)
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="User Avatar" class="rounded-circle" width="40">
                            @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 'm')
                            <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle" width="40">
                            @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 'f')
                            <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle" width="40">
                            @endif
                            <a href="{{ url('/users/' . Auth::id()) }}" class="ml-sm-2">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="align-self-center ml-sm-4">
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <a href="{{ url('/users/' . Auth::user()->id . '/friends') }}" class="mr-sm-4"><ion-icon size="large" name="contacts" title="Friends"></ion-icon><span class="badge badge-pill badge-info">{{ Auth::user()->friends()->count() }}</span></a>
                            <a href="{{ url('/notifications') }}" class="mr-sm-4"><ion-icon size="large" name="globe" title="Notifications"></ion-icon><?= Auth::user()->unreadNotifications->count() > 0 ? '<span class="badge badge-pill badge-danger">' . Auth::user()->unreadNotifications->count() . '</span>' : ''?></a>
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{-- {{ Auth::user()->name }} <span class="caret"></span> --}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/users/' . Auth::id() . '/edit' ) }}"><ion-icon name="settings"></ion-icon> {{ __('Settings') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <ion-icon name="log-out"></ion-icon> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>
</body>

</html>