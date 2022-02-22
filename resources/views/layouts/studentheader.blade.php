<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TREnglish</title>
    {{-- WebIcon --}}
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm CustomNav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- TREnglish --}}
                    <img src="{{ asset('images/Logo.png') }}" alt="" width="120" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ListItem">
                            <a href="" class="LinkItem">Learn</a>
                        </li>

                        <li class="nav-item ListItem">
                            <a href="" class="LinkItem">Work with us</a>
                        </li>

                        <li class="nav-item ListItem">
                            <a href="" class="LinkItem">How to </a>
                        </li>
                        <li class="nav-item ListItem">
                            <a href="" class="LinkItem">Unlimited benefits </a>
                        </li>


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest('student')
                            {{-- {{ route('login') }} --}}
                            {{-- @if (Route::has('student.login')) --}}
                            @if (route('student.login'))
                                {{-- <div class="dropdown ListItem" id="LoginDropDown"> --}}
                                    {{-- <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        Login --}}
                                    {{-- </a> --}}
                                    {{-- <ul class="dropdown-menu"> --}}
                                            <li class="nav-item ListItem">
                                                <a class="nav-link" href="{{route('student.login')}}">Student login</a>
                                            </li>
                                    {{-- </ul>
                                </div> --}}

                            @endif

                            @if (route('student.register'))
                                {{-- <div class="dropdown ListItem" id="LoginDropDown">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        Register
                                    </a> --}}
                                    {{-- <ul class="dropdown-menu"> --}}
                                            <li class="nav-item ListItem">
                                                <a class="nav-link" href="{{route('student.register')}}">Student register</a>
                                            </li>
                                    {{-- </ul>
                                </div> --}}
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('student')->user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('student.logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item ListItem">
                                <a href="{{route('student.dashboard')}}" class="nav-link">
                                    Dashboard
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container LoginRegisterLinks ToggleLinks2">

        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
