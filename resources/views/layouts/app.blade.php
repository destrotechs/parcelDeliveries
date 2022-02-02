<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css') }}">
    
    <style type="text/css">
        body{
            background-color: #24c6dc;
        }
        body {
    width: 100%;
    height: 100%;
}

html {
    width: 100%;
    height: 100%;
}

* ===== NAVIGATION ======*/
.navbar {
    border: 0;
    z-index: 9999;
    letter-spacing: 4px;

}
.logo {
    display: block;
    height: auto;
    width: 52px;
    padding-top: 5px;
    margin-right: 15px;
}

.navbar-brand>img {
  height: 100%;
  padding: 15px; /* firefox bug fix */
  width: auto;
}
.navbar .nav > li > a {
  line-height: 50px;
}

.navbar-header h1 {
    letter-spacing: 1px;
    color: black !important;
    font-family: 'Lobster Two', cursive;
}

.navbar li a, .navbar {
    color: white !important;
    font-size: 18px;
    transition: all 0.6s 0s;
}

.navbar-toggle {
    background-color: transparent !important;
    border: 0;
}

.navbar-nav li a:hover, .navbar-nav li.active a {
    color: silver !important;
}


    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top"  style="background: #24c6dc;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold;font-family: monospace;font-size: 150%;letter-spacing: 1px;
    color: white !important;
    font-family: 'Lobster Two', cursive;">
                    {{ config('app.name', 'Fulcrum') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                                <a href="#" class="nav-link" style="color: white;">Station Parcels</a>
                            </li>
                            <li class="nav-item"> 
                                <a href="#" class="nav-link" style="color: white;">New Parcel</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                    {{ Auth::user()->station_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" style="background-color:#24c6dc;" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
