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

<body class="bg-light">
    <div class="container-jumbotron TopBar1">
        <a href="{{ url('/student/dashboard') }}"><i class="fa-solid fa-house"></i>Dashboard</a>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>Ad creation dashboard</h2>
                <h6 class="mb-3">
                    Finding teachers quickly is guaranteed with an ad just
                    <span style="color: #029e02">$2.99 Only</span>
                </h6>
                <div class="row bg-white p-3">
                    <div class="col-md-2 d-flex justify-content-center align-content-center">
                        <img src="/images/attention.png" alt="attention" />
                    </div>
                    <div class="col-md-9 d-flex justify-content-start">
                        <p>
                            In order to create a job ad for teachers to see, we recommend that you 
                            add your <span style="color: #029e02">profile image</span> and <span style="color: #029e02">country</span> in the
                            profile section. You can do this by clicking on
                            your name in the navigation bar and going to the
                            profile section <a href="{{url('/student/edit/profile')}}" style="color:#029e02; ">Edit profile</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    {{-- end details --}}

    {{-- Ad form --}}
    <div class="container p-4">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8  p-3">
                <form action="{{ url('/student/create/ad') }}" method="post">
                    @csrf
                    <input type="hidden" name="ad_fee" id="adFee" value="10">
                   
                    <div class="form-floating mb-3 mt-3">
                        <div class="mb-3 mt-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                value="{{ old('title') }}" placeholder="Enter ad title" name="title" required />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <label for="ad_description">Ad description</label>
                    <textarea class="form-control @error('ad_description') is-invalid @enderror" rows="5" id="ad_description"
                        name="ad_description" placeholder="Say something about your ad..." required  >{{ old('ad_description') }}</textarea>
                    @error('ad_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mt-3">
                        <label for="langauge">Choose language</label>
                        <select name="language" class="form-select" id="langauge">
                            <option>English</option>
                            <option>Spanish</option>
                            <option>French</option>
                            <option>Arabic</option>
                        </select>
                    </div>
                    <br />
                    <p>
                        What's your budget range. For example ($3 USD - $5
                        USD)
                    </p>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3 mt-3">
                                <input type="number" class="form-control @error('minamount') is-invalid @enderror"
                                    name="minamount" required placeholder="minamount" value="{{ old('minamount') }}"/>
                                @error('ad_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3 mt-3">
                                <input type="number" class="form-control @error('maxamount') is-invalid @enderror"
                                    name="maxamount" placeholder="Maximum budget" required value="{{ old('maxamount') }}"/>
                                @error('maxamount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3 mt-3">
                                <select name="currency" class="form-select">
                                    <option>USD</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <p>I'm looking for:</p>
                        <select name="gender" class="form-select">
                            <option>Male teacher</option>
                            <option>Female teacher</option>
                            <option>Any teacher</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn PaymentBtn" >
                            Proceed to payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end ad form --}}
    
    <script src="{{ mix('js/app.js') }}" defer></script>

</body>

</html>
<style>
    body {
        color: #183153
    }

    .TopBar1 {
        box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
        -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
        -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
        background-color: white;
        padding: 25px;
    }

    .TopBar1 a {
        text-decoration: none;
        color: #183153
    }

    .MyPaypal {
        display: none;
    }

    input:focus, .form-select:focus {
        box-shadow: none;
        outline: 0;
        border: 1px solid #029e02;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .PaymentBtn {
        background-color: #029e02;
        color: white;
    }

    .PaymentBtn:hover {
        background-color: #04ad04;
        color: white;
    }

</style>
