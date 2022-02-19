<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>TREnglish</title> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
    {{-- flags --}}
    <link href="{{ asset('css/flags.css') }}" rel="stylesheet">
    <title>TREnglish</title>
    <link rel="icon" href="{{asset('images/Logo.png')}}" >


    {{-- flag Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css"
        integrity="sha512-UwbBNAFoECXUPeDhlKR3zzWU3j8ddKIQQsDOsKhXQGdiB5i3IHEXr9kXx82+gaHigbNKbTDp3VY/G6gZqva6ZQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Owl corousel --}}
    <link rel="stylesheet" href="{{ asset('Carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Carousel/assets/owl.theme.default.min.css') }}">
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>

    @extends('layouts.mainheader')
    @section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 p-0">
                    <div class="">
                        <div class="card-body">
                            {{-- @php
                                if (condition) {
                                }
                            @endphp --}}
                            <h2>Start learning with <span class="PriceTag">ONLY 90TL</span> </h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 mb-3 p-0">
                    <div style=" margin-left: auto;
                        margin-right: auto; background-color:rgb(2, 158, 2)">
                        <h2 style="padding: 10px; text-align:center; color:#FFFFFF">Our platforms</h2>
                    </div>
                    <table class="table table-striped table-hover">
                        {{-- <thead > --}}
                        {{-- </thead> --}}
                        <tbody>
                            <tr>
                                <td><img src="platforms/zoom.png" alt="" width='20' height="20"></td>
                                <td>Zoom</td>
                            </tr>
                            <tr>
                                <td><img src="platforms/googleMeet.png" alt="" width='20' height="20"></td>
                                <td>Google meet</td>
                            </tr>

                            <tr>
                                <td><img src="platforms/googleHangout.png" alt="" width='20' height="20"></td>
                                <td>Google hangouts</td>
                            </tr>
                            <tr>
                                <td><img src="platforms/teams.png" alt="" width='20' height="20"></td>
                                <td>Microsoft Teams</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 mr-2 p-2 WorkersContainer">
                    <h3>Our profesional Tutors</h3>
                    <p>We have the best team of international Tutors from all over the world who are
                        ready to give you an amazing push into the new language of your choice.</p>
                    <div class="owl-carousel">
                        <div class="border">
                            <img src="{{ asset('images/Green.jpg') }}" alt="">
                            <div class="container-jumbotron Details">
                                <span class="Nationality flex-box">
                                    FROM: MALAWI

                                    <div class="flags_img iso_US"></div>

                                </span><br>
                                <span class="Language">Native English Speaker</span>
                            </div>
                        </div>
                        <div>
                            <img src="{{ asset('images/Green2.png') }}" alt="">
                            <p>
                            <h6>Nationality: Malawi</h6>
                            </p>
                        </div>

                    </div>
                </div>
                {{-- <div class="col-lg-2 col-md-2 ">
                </div> --}}
                <div class="col-lg-4 col-md-4 border p-2">
                    <div id="vueapp">
                        <vue-app></vue-app>
                    </div>
                </div>
            </div>


        @endsection



        <script src="{{ asset('Carousel/owl.carousel.min.js') }}"></script>
</body>
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/countries.js') }}"></script>

</html>
<script>

</script>
