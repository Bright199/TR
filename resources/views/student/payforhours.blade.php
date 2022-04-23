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

    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    @if (Session::get('lessonDetails'))
    <div class="container-jumbotron">
        <div class="container  p-4">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3"></div>
                <div class="col-md-6 col-sm-6 col-lg-6 bg-white p-5">
                    <div class="container p-0 border-bottom">
                        <p>You are closer to learning your prefered language with <span style="color: #029e02">World
                                Class</span> teachers.</p>
                    </div>
                    <div class="container p-0  mt-2">
                        <h4>Lesson details</h4>
                    </div>
                    <div class="container p-0">
                        <input type="hidden" name="" value="{{ Session::get('lessonDetails')['hourly_pay'] }}" id="hourly_pay">
                        <input type="hidden" name="" value="{{ Session::get('lessonDetails')['booked_hours'] }}" id="booked_hours">
                        <input type="hidden" name="" value="{{ Session::get('lessonDetails')['package'] }}" id="package">
                        <input type="hidden" name="" value="{{ Session::get('lessonDetails')['totalPrice'] }}" id="totalPrice">
                        <input type="hidden" name="" value="{{ Session::get('lessonDetails')['teacherId'] }}" id="teacherId">
                        <p>Your teacher is: <span
                                style="color: #029e02">{{ Session::get('lessonDetails')['teacherName'] }}</span></p>
                        <p>Each lesson: <span
                                style="color: #029e02">${{ Session::get('lessonDetails')['hourly_pay'] }}/hour</span>
                        </p>
                        <p>You save: <span
                                style="color: #029e02">${{ Session::get('lessonDetails')['youSave'] }}</span>
                        </p>
                        <p><span>You are buying: </span> <span
                                style="color: #029e02;">{{ Session::get('lessonDetails')['booked_hours'] }}
                                hours</span></p>
                        <p><span>Package type: </span> <span
                                style="color: #029e02;">{{ Session::get('lessonDetails')['package'] }} </span></p>
                    </div>
                    <div class="container p-0 border-bottom">
                        <h4>Total fee: ${{ Session::get('lessonDetails')['totalPrice'] }}</h4>
                    </div>
                    <div class="container p-3 border-bottom">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="option1"
                                value="something">
                            <label class="form-check-label" for="terms-conditions" data-bs-toggle="modal"
                                data-bs-target="#termsConditions"><span style="text-decoration: none;">I agree to</span>
                                <span style="text-decoration: underline" class="text-primary">Terms &
                                    conditions</span>
                                </label>
                        </div>
                        <p class="text-danger" id="agreeTerms">Checkbox must be checked.</p>
                    </div>
                    <div class="container p-3">
                        <div class="d-grid">
                            <button id="payNow">Pay Now</button>
                        </div>
                        <div id="paypal-button-container"></div>
                    </div>

                </div>
                <div class="col-md-3 col-sm-3 col-lg-3 Links p-4">
                    <p><a href="{{ url('student/dashboard') }}">Dashboard</a></p>
                    <p><a href="{{ url('student/all/booked/lessons') }}">My lessons</a></p>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="container p-4">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6 p-3 bg-white ">
                    <p class="text-center">Your request is lacking some details. Try again</p>
                </div>
                <div class="col-md-4 Links p-4 ">
                    <p><a href="{{ url('student/dashboard') }}">Dashboard</a></p>
                    <p><a href="{{ url('student/all/booked/lessons') }}">My lessons</a></p>
                </div>
            </div>
        </div>
    @endif
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="termsConditions" tabindex="-1" aria-labelledby="termsConditions" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsConditions"><span style="color: #029e02">TREnglish</span> terms
                        of service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>1. On TREnglish, you can be able to transfer the remaining hours to another teacher. This
                        happens under the condition that the current teacher doesn't meet your need or in cases when the
                        current teacher can not continue teacher you. <span style="color: #029e02">NOTE!</span> You are
                        required to give proper information
                        as to why you intend to transfer your hours to another teacher. After a short time you would be
                        provided with another teacher.</p>
                    <p>2. Here on TREnglish, you are able to get a refund of the remaining money in cases when you are
                        not
                        satisfied with services offered to you. In such cases you are to send us a report as to why you
                        require to get a refund. You are to let us know on time so that we take proper actions to meet
                        your demands.</p>

                    <p>3. Your lesson is considered to have taken place in cases when you are supposed to attend a
                        lesson but did not show up without giving an excuse to the teacher at least 2 hours before the
                        lesson. Be
                        sure to communicate with your teacher on time. Let your teacher know in cases when you can not
                        attend the lesson the lesson the lesson and arrange another time to meet.</p>
                    <p>4. In cases when your teacher does not show up when your lesson is scheduled your money will not
                        be
                        deducted. You can report a teacher in cases when there is unprofessional conducts.</p>

                    <p>5. Be sure to be on time for each lesson. Each lesson on TREnglish is considered to be 1 hour
                        long.
                        Therefore, coming on time will make it possible for you to have all the time with your teacher.
                    </p>
                </div>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#payNow').click(function() {
                if ($('#terms-conditions').is(':checked')) {
                    $('#payNow').css({
                        'display': 'none'
                    })
                    $('#paypal-button-container').css({
                        'display': 'block'
                    })
                } else {
                    $('#terms-conditions').css({
                        'border': '1px solid red'
                    })
                    $('#agreeTerms').css({
                        'display': 'block'
                    })
                }
            });

            $('#terms-conditions').click(() => {
                if ($('#terms-conditions').is(':checked')) {
                    $('#payNow').css({
                        'display': 'none'
                    })
                    $('#terms-conditions').css({
                        'border': '1px solid #007BFF'
                    })
                    $('#paypal-button-container').css({
                        'display': 'block'
                    })
                    $('#agreeTerms').css({
                        'display': 'none'
                    })
                } else {
                    $('#payNow').css({
                        'display': 'block'
                    })
                    $('#terms-conditions').css({
                        'border': '1px solid gray'
                    })
                    $('#paypal-button-container').css({
                        'display': 'none'
                    })
                }
            })
        })

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
                                "value": parseFloat($('#totalPrice').val())
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
                        element.innerHTML = '<h3>Thank you for your payment!</h3>';

                            $(document).ready(function() {
                                const teacherId = $('#teacherId').val();
                                const booked_hours = $('#booked_hours').val();
                                const hourly_pay = $('#hourly_pay').val();
                                const totalPrice = $('#totalPrice').val();
                                const package = $('#package').val();
                                const data = {
                                    teacherId: teacherId,
                                    booked_hours: booked_hours,
                                    hourly_pay: hourly_pay,
                                    totalPrice: totalPrice,
                                    package: package,
                                    orderData: orderData
                                }
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    }
                                })
                                $.ajax({
                                    url: "/student/paidlesson/insert/payment/details",
                                    type: "POST",
                                    data: data,
                                    // async : false, 
                                    success: function(response, textStatus, jqXHR) {
                                    window.location  = '/student/paidlesson/booking/payment/summary/'+teacherId
                                        // console.log(response)
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(errorThrown);
                                    }
                                });
                            })

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
        color: #183153;
        background-color: #f8f9fa;

    }

    .form-check-label:hover {
        cursor: pointer;
    }

    .Links a {
        text-decoration: none;
        background-color: #029e02;
        color: white;
        padding: 2px 15px 4px;
    }
   
    .Links a:hover {
        color: white;
    }

    #payNow {
        border: 1px solid #029e02;
        padding: 2px 0px 4px;
        background-color: white;
        margin-bottom: 2px;
        border-radius: 3px;
        transition: 0.3s;
    }

    #payNow:hover {
        background-color: #029e02;
        color: white;
        cursor: pointer;
    }

    #paypal-button-container {
        display: none
    }
    #agreeTerms {
        display: none
    }

</style>
