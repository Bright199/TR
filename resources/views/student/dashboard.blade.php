<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TREnglish</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="vueapp">
        @if(Auth::guard('student')->user())
        <nav-bar :user="{{json_encode(Auth::guard('student')->user())}}"></nav-bar>
        @else
        <nav-bar :user="false"></nav-bar>
        @endif
    </div>

    <h1>Welcome student dashboard</h1>
    <p>Welcome {{Auth::guard('student')->user()->name }} to student's dashboard</p>
    <a class="dropdown-item" href="{{ route('student.logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>

</html>
<script src="{{ mix('js/app.js') }} " defer></script>