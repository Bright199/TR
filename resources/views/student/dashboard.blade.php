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

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div id="vueapp">
        {{-- Navigation --}}
        @if(Auth::guard('student')->user())
        <nav-bar :user="{{json_encode(Auth::guard('student')->user())}}"></nav-bar>
        @else
        <nav-bar :user="false"></nav-bar>
        @endif
        {{-- Navifation --}}
        <div class="container-jumbotron">
            <div class="row">
                <div class="col-md-3 LeftBarStudent">
                    <left-bar></left-bar>
                </div>
                <div class="col-md-8">
                    <right-bar></right-bar>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="{{ mix('js/app.js') }}" defer></script>
<script>
    $(document).ready(function(){
        // $('.Logout').mouseover(function(){
           
        // })
    })
</script>
<style>
    .LeftBarStudent{
        /* padding: 0; */
        
    }
</style>