<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 py-3 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">BoolPress</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            @guest
            @else
            <li class="nav-item text-nowrap">
                <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
             </form>
            </li>
            @endguest
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse border-right border-dark">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.home')}}">
                            <span data-feather="home"></span>
                            Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.posts.index')}}">
                            <span data-feather="file"></span>
                            Posts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.categories.index')}}">
                            <span data-feather="file"></span>
                            Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.tags.index')}}">
                            <span data-feather="file"></span>
                            Tags
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-5">
            @yield('content')
            
            </main>
        </div>
    </div>   
    <footer></footer>
</div>
</body>
</html>