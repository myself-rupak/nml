<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (!empty($title))?$title:config('app.name') }}</title>

    <!-- Scripts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <!--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/fileinput.js') }}" defer></script>
    <script src="{{ asset('dist/summernote-bs4.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/summernote-bs4.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Nitol Motors Limited') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                    class="nav-link dropdown-toggle" 
                                    data-toggle="dropdown"
                                    role="button"
                                    aria-haspopup="true" 
                                    aria-expanded="false" v-pre
                                    href="javascript:void(0)">Product
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{!! url('/product_category'); !!}">Product category</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{!! url('/product_specification'); !!}">Product specfication</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{!! url('/product_item'); !!}">Product list</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/parent_menu'); !!}">Parent menu</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/hero_slider'); !!}">Hero slider</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                    class="nav-link dropdown-toggle" 
                                    data-toggle="dropdown"
                                    role="button"
                                    aria-haspopup="true" 
                                    aria-expanded="false" v-pre
                                    href="javascript:void(0)">Touch Points
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{!! url('/districts'); !!}">District</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{!! url('/thanas'); !!}">Thana</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{!! url('/touch_point_list'); !!}">Touch points</a>
                                    </li>
                                </ul>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{!! url('/product_category'); !!}">Product category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/product_specification'); !!}">Product specfication</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/product_item'); !!}">Product list</a>
                            </li>-->
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/media_center'); !!}">Media center</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/upcoming_vehicles_news'); !!}">Upcoming</a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            
                        @else
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>-->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
</body>
</html>
