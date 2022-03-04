<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @foreach ($teacher as $detail)
        {{$detail->name}}
        @endforeach
    </title>
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

    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div id="vueapp">

    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4 ">
                        <img src="{{ asset('images/Green2.png')}}" alt="" width="100%">
                    </div>
                    <div class="col-md-8 border shadow-sm">
                        @foreach ($teacher as $detail)
                        <h3>{{$detail->name}}
                            &nbsp;<i class="fa-solid fa-shield-blank" style="color:#029e02; font-size:18px"></i>
                        </h3>
                        <p>{{$detail->description}}</p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9 d-flex justify-content-end">
                                    <p>
                                        Speaks {{$detail->first_language}} <span class="MainFluencyLevel"
                                            style="font-weight:500;  
                                           ">{{$detail->first_language_proficiency}}</span> {{$detail->second_language}}
                                            <span class="FluencyLevel"
                                            style="font-weight:500; ">{{$detail->second_language_proficiency}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if ($detail->our_tearcher ===1)
                        <p>Works for <span style="font-weight: 500; color:#029e02">TREnglish </span> </p>
                        @endif
                        <p style="font-weight:700; font-size:16px"><i
                                class="fa-solid fa-dollar-sign"></i>{{$detail->hourly_pay}} USD /hour</p>
                        <p>Joined on {{date('d-m-Y', strtotime( $detail->created_at))}}</p>
                        <p>{{$detail->nationality}}</p>
                        @endforeach

                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-3">
                @foreach ($teacher as $detail)
                <a href="" class="hireBtn">Hire {{$detail->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="row">
        {{$teacher}}

    </div> --}}


</html>
<script src="{{ mix('js/app.js') }}" defer></script>
<style>
    .hireBtn {
        text-decoration: none;
        font-size: 15px;
        background-color: #fec107;
        color: #151419;
        padding: 10px;
    }

    .MainFluencyLevel {
    color: #029e02;
    background-color: rgb(2, 158, 2, 0.1);
    padding: 4px;
    border-radius: 5px;
}
.FluencyLevel {
    color: #027a9e;
    background-color: rgba(2, 83, 158, 0.1);
    padding: 4px;
    border-radius: 5px;
}
</style>