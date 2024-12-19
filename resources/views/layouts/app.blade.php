<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-store') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            background: #313651;

        }
        nav {  
            position: relative;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 50px;
            background-color: #262B43;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            background:  #262B43;
        }
        .logo {
            position: relative;
            width: 50px;
            height: 50px;
            left: 10px;
            top: 0px;
        }
        a .navbar-brand{
            position: relative;
            width: 100%;
            height: 60px;
            left: 214px;
            top: 25px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 30px;
            line-height: 15px;
            color: #FFFFFF;
        }
    </style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img class="logo"src="{{ asset('logo.png') }}" alt="logo">
                <a class="navbar-brand" href="{{ route('index_product') }}">
                    TOKO-RPL
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('create_product') }}">
                                            Create product
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('show_cart') }}">
                                            Cart
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('index_order') }}">
                                        Order
                                    </a>
                                    <a class="dropdown-item" href="{{ route('show_profile') }}">
                                        Profile
                                    </a>
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

        <main class="w">
            @yield('content')
        </main>
    </div>
</body>

</html>
