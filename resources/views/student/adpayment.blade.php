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

    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
        data-sdk-integration-source="button-factory"></script>

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light">
    @if (Session::get('adDetails'))
        <div class="container p-3 bg-white">
            <div class="row">
                <div class="col-md-3">

                    <img src="{{ asset('images/payment.png') }}" alt="" width="250">
                </div>
                <div class="col-md-9 shadow-sm">
                    <div class="container border-bottom">
                        <p class="text-center">Your ad preview (Cost of ad <span
                                style="color: #029e02">${{ Session::get('adDetails')->ad_fee }} USD</span>)</p>
                    </div>
                    <input type="hidden" name="" id="adFee" value="{{ Session::get('adDetails')->ad_fee }}">
                    <div class="container">
                        <p>Title: <span style="color: #029e02">{{ Session::get('adDetails')->title }}</span></p>
                    </div>
                    <div class="container">
                        <p>{{ Session::get('adDetails')->description }}</p>
                    </div>
                    <div class="container">
                        <p>Looking for: <span
                                style="color: #029e02">{{ Session::get('adDetails')->student_gender }}</span></p>
                    </div>
                    <div class="container">
                        <p>Language: <span
                                style="color: #029e02">{{ Session::get('adDetails')->language_category }}</span></p>
                    </div>
                    <div class="container border-bottom">
                        <h5>Price range:
                            ${{ Session::get('adDetails')->minimum_budget }} USD -
                            ${{ Session::get('adDetails')->maximum_budget }} USD
                        </h5>
                    </div>

                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/guaranty.png') }}" alt="">
                            </div>
                            <div class="col-md-6">
                                <p>Pay for your ad. Your payment on <span style="color: #029e02">TREnglish</span> are
                                    very secure!</p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-6">
                                <div id="paypal-button-container" class="MyPaypal"></div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 p-4">
                    <img src="{{ asset('images/anouncement.png') }}" alt="">
                    <p>Check <span style="color:#029e02">'My ads'</span> section for all your (paid, unpublished,
                        published etc) ads.</p>
                    <a href="{{ url('/student/ad/management') }}"
                        style="background-color: #029e02; color:white; padding: 2px 15px 7px; text-decoration: none;">My ads</a><br><br>
                    <p>Create a job ad for teachers to see and contact you.</p>
                    <a href="{{ url('/student/create/ad') }}"
                        style="background-color: #029e02; color:white; padding: 2px 15px 7px; text-decoration: none;">Create
                        job advert</a><br><br>
                    <a href="{{ url('/student/dashboard') }}" style="color: #029e02;text-decoration: none;"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @endif


    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'pay',
                    height: 30

                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            "amount": {
                                "currency_code": "USD",
                                "value": parseFloat(document.getElementById('adFee').value)
                            }
                        }]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        // Full available details
                        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        // Show a success message within this page, e.g.
                        const element = document.getElementById('paypal-button-container');
                        element.innerHTML = '';
                        alert('Your ad has been submitted waiting for approval');
                        window.location = '/student/ad/management';

                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>
</body>

</html>
<style>
    body {
        color: #183153
    }

</style>
