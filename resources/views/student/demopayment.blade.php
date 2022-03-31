<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TREnglish</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

<body >



    <div>
        <div class="container-jumbotron shadow-sm py-3">
            <div class="row">
                <div class="col-md-4 ms-3">
                    <a href="/student/book/demo/lesson/{{ $teacherDetails->id }}" class="DashboardClass">
                        <i class="fa-solid fa-angle-left"></i>
                        Calendar
                    </a>
                    <a href="" class="DashboardClass" style="color:brown" data-bs-toggle="modal"
                        data-bs-target="#myModal">
                        <span><i class="fa-solid fa-xmark"></i>
                            Cancel</span>
                    </a>
                </div>
                <div class="col-md-7">
                    <ul class="d-flex CrumbContainer">
                        <li class="text-center">1. Select time</li>
                        <li class="text-center">
                            <i class="fa-solid fa-angle-right"></i>
                        </li>
                        <li class="text-center activeCrumb">2. Make a payment</li>
                        <li class="text-center">
                            <i class="fa-solid fa-angle-right"></i>
                        </li>
                        <li class="text-center">3. Prepare your lesson</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @isset($trialLessonDetails[0])
        {{-- Modal --}}
        <!-- Button to Open the Modal -->

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <p class="modal-title">Are you sure you want to cancel?</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>


                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="/student/cancel/book/demo/lesson/{{ $teacherDetails->id }}"
                            class="CancelDemoBooking">Cancel booking</a>
                    </div>

                </div>
            </div>
        </div>
        {{-- end --}}
        {{-- Trial lesson Details --}}
        <div class="container-jumbotron body" id="MainContainer">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 p-0"></div>
                    <div class="col-md-4 p-4 bg-white me-5 BookingDetails"
                        style="border-top-right-radius: 7px;border-top-left-radius: 7px">
                        <div class="container-jumbotron border-bottom p-3">
                            <div class="row">
                                @if ($teacherDetails)
                                    <div class="col-md-2">
                                        @if ($teacherDetails->teacher_image !== null)
                                            <img src="{{ asset('images/' . $teacherDetails->teacher_image) }}" alt=""
                                                width="50" height="50" style="border-radius: 50%; padding:2px">
                                        @else
                                            <img src="{{ asset('images/avatar.png') }}" alt="" width="50" height="50"
                                                style="border-radius: 50%; padding:2px">
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <p style="margin-bottom:0">
                                            {{ $teacherDetails->name }}
                                        </p>
                                        <p style="font-size: 13px;"><i class="fa-solid fa-chalkboard-user"
                                                style="color:#fec107"></i>
                                            {{ $teacherDetails->first_language }} </p>
                                    </div>
                                @else
                                    <p>Check the teachers section to hire a teacher</p>
                                @endif
                            </div>


                        </div>
                        <div class="container-jumbotron p-2 border-bottom">
                            <p style="margin-bottom: 1px; font-size: 20px; color:#b6b5b5">Date and Time</p>
                            <p>{{ date('l, j F', strtotime($trialLessonDetails[0]->date)) .
                                ', ' .
                                date('H:i', strtotime($trialLessonDetails[0]->timeslot)) }}
                            </p>
                            <img src="{{ asset('images/clock.png') }}" alt="" width='100'>
                        </div>
                        <div class="container-jumbotron p-2 border-bottom">
                            <p style="margin-bottom: 1px; font-size: 20px; color:#b6b5b5">Details</p>
                            <table class="table table-sm borderless p-0">

                                <tbody>
                                    <tr>
                                        <td>1 hour lesson</td>
                                        <td style="font-weight:500;text-align:end">
                                            $<span>{{ $teacherDetails->hourly_pay }}</span></td>
                                        <input type="text" value="{{ $teacherDetails->hourly_pay }}" id="hourlyPrice"
                                            hidden>
                                        <input type="text" value="{{ $teacherDetails->id }}" id="teacherId" hidden>
                                    </tr>
                                    <tr>
                                        <td>Transaction fee</td>
                                        <td style="font-weight:500;text-align:end">$0.30</td>
                                        <input type="text" value="{{ 0.3 }}" id="transactionFee" hidden>
                                    </tr>
                                    <tr>
                                        <td>Cancellation fee</td>
                                        <td style="color:#029e02;text-align:end"><span>Free</span></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="container-jumbotron p-2 ">

                            <table class="table table-sm borderless p-0">

                                <tbody>

                                    <tr>
                                        <td>
                                            <p style="font-weight:500; font-size: 20px; color:#777777">Total</p>
                                        </td>
                                        <td>
                                            <p id="TotalPrice"
                                                style="font-weight:500;text-align:end; font-size: 20px; color:#777777"></p>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-md-6 bg-white p-3" style="border-top-right-radius: 7px;border-top-left-radius: 7px">
                        <div class="container-jumbotron border-bottom p-3">
                            <p class="d-flex justify-content-center"
                                style="font-weight:500; font-size: 20px; color:#777777">Secure checkout</p>
                        </div>
                        <div class="container-jumbotron border-bottom p-3">
                            <p style="color:#777777">It’s safe to pay on TREnglish. All
                                transactions are protected by SSL encryption.</p>
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('images/secure.png') }}" alt="" width="200">
                            </div>
                        </div>
                        <div class="container">
                            <div class="p-3 border-bottom">
                                <div class="">
                                    <div id="smart-button-container">
                                        <div style="text-align: center;">
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row p-3">
                                    <div class="col-md-2 d-flex justify-content-center  align-items-center">
                                        {{-- <i class="fa-solid fa-check-double" style="color:#029e02; font-size: 30px"></i> --}}
                                        <img src="{{ asset('images/guaranty.png') }}" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p style="color:#777777">Learn with 100% satisfaction guarantee
                                            If your lesson does not take place, or you are not satisfied with the tutor,
                                            we will provide you with a free replacement to another tutor of your choice or
                                            offer you a full refund.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        {{-- end --}}
    </div>
    <div>



        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
                data-sdk-integration-source="button-factory"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script>
            // Total
            $(document).ready(function() {
                const TotalPrice = parseFloat($('#hourlyPrice').val()) + parseFloat($('#transactionFee').val())
                document.getElementById('TotalPrice').innerHTML = '$' + TotalPrice
            })
            // 
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function() {
                window.history.go(1);
            };
            
            function initPayPalButton() {
                paypal.Buttons({
                    style: {
                        shape: 'rect',
                        color: 'gold',
                        layout: 'vertical',
                        label: 'pay',
                        height: 40

                    },

                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                "amount": {
                                    "currency_code": "USD",
                                    "value": parseFloat(document.getElementById('hourlyPrice').value) + parseFloat(document.getElementById('transactionFee').value)
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
                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';

                            $(document).ready(function() {
                                const teacherId = $('#teacherId').val();
                                const data = {
                                    teacherId: teacherId,
                                    orderData: orderData
                                }
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    }
                                })
                                $.ajax({
                                    url: "/student/insert/payment/details",
                                    type: "POST",
                                    data: data,
                                    // async : false, 
                                    success: function(response, textStatus, jqXHR) {
                                    window.location  = '/student/demo/booking/payment/summary/'+teacherId
                                        // console.log(response)
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(errorThrown);
                                    }
                                });
                            })

                        });
                    },
                    onCancel: function() {
                        alert('you cancelled the payment');
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
<style scoped>
    .CancelDemoBooking {
        background-color: #029e02;
        text-decoration: none;
        padding: 5px 15px;
        color: white
    }

    .CancelDemoBooking:hover {
        background-color: #039b03;
        color: white
    }

    body {
        color: #183153;
    }

    .body {
        background-color: #e7ebe7;
        padding: 25px;
        min-height: 800px;
        height: 100%;
    }

    .activeCrumb {
        font-weight: 550;
        list-style: none;
        margin-right: 10px;
    }

    .CrumbContainer li:not(.activeCrumb) {
        list-style: none;
        margin-right: 10px;
        color: #79787c;
    }

    .CrumbContainer {
        flex-wrap: wrap;
    }

    .fa-angle-left {
        color: #020202;
    }

    .DashboardClass {
        /* font-size: 18px; */
        margin-right: 25px;
        color: #151419;
        text-decoration: none;
    }

    .BookingDetails {
        max-height: 600px;
        min-height: 300px;
    }

    .borderless td,
    .borderless th {
        border: none;
    }

</style>
