<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>TREnglish</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <div class="p-4">
        {{-- Lesson Packages --}}
        <div class="row bg-white p-4 d-flex justify-content-center">
            {{-- STARTER --}}
            <div class="col-md-3 col-lg-3 col-sm-3 p-0 bg-white me-2 mb-2 border">
                <div class="container p-0 StarterHeadingContainer">
                    <p class="text-white text-center p-3 m-0 Heading">STARTER</p>
                </div>
                <div class="container packageDetails p-3 ">
                    <p class="text-center"><span class="numberOfLessons ">5</span><span
                            class="textLessons">Lessons</span></p>
                </div>
                <div class="container p-0">
                    <p class="text-center"><span class="themeColor">Teacher: </span>{{ $teacherDetails->name }}
                    </p>
                    <p class="text-center" v-if="loaded"><span class="themeColor">Teacher's fee:
                        </span>${{ $teacherDetails->hourly_pay }}/hour</p>
                    <p class="text-center" v-if="loaded"><span
                            class="totalPrice">${{ floatval($teacherDetails->hourly_pay) * floatval(5) - floatval(2.5) }}</span>
                    </p>
                    <p class="text-center"><span class="themeColor">You save $2.5</span></p>
                </div>
                <div class="container p-0 d-flex justify-content-center">
                    <button class="buyBtn d-block text-center " id="buyHours">Buy Hours</button>
                    <input type="hidden" name="" value="5" id="LessonHours">
                    <input type="hidden" name="" id="LessonTotalFee"
                        value="{{ floatval($teacherDetails->hourly_pay) * floatval(5) - floatval(2.5) }}">
                </div>
                <div class="container packageBenefits p-3">
                    <p><i class="fa-solid fa-circle-check"></i> Transfer hours to another teacher if teacher doesn't
                        meet your needs.</p>
                    <p><i class="fa-solid fa-circle-check"></i> Ask for refund for the remaining hours (If applicable)
                    </p>
                </div>
            </div>
            {{-- END STARTER --}}

            {{-- PRO --}}
            <div class="col-md-3 col-lg-3 col-sm-3 p-0 bg-white me-2 mb-2 border">
                <div class="container p-0 ProHeadingContainer">
                    <p class="text-white text-center p-3 m-0 Heading">PRO</p>
                </div>
                <div class="container packageDetails p-3 ">
                    <p class="text-center"><span class="numberOfLessons ">12</span><span
                            class="textLessons">Lessons</span></p>
                </div>
                <div class="container p-0">
                    <p class="text-center"><span class="themeColor">Teacher:
                        </span>{{ $teacherDetails->name }}
                    </p>
                    <p class="text-center" v-if="loaded"><span class="themeColor">Teacher's fee:
                        </span>${{ $teacherDetails->hourly_pay }}/hour</p>
                    <p class="text-center" v-if="loaded"><span
                            class="totalPrice">${{ floatval($teacherDetails->hourly_pay) * floatval(12) - floatval(4.5) }}</span>
                    </p>
                    <p class="text-center"><span class="themeColor">You save $4.5</span></p>
                </div>
                <div class="container p-0 d-flex justify-content-center">
                    <button class="buyBtn d-block text-center " id="buyHours">Buy Hours</button>
                    <input type="hidden" name="" value="{{ $teacherDetails->id }}" id="TeacherId">
                    <input type="hidden" name="" value="5" id="LessonHours">
                    <input type="hidden" name="" id="LessonTotalFee"
                        value="{{ floatval($teacherDetails->hourly_pay) * floatval(12) - floatval(4.5) }}">
                </div>
                <div class="container packageBenefits p-3">
                    <p><i class="fa-solid fa-circle-check"></i> Transfer hours to another teacher if teacher doesn't
                        meet your needs.</p>
                    <p><i class="fa-solid fa-circle-check"></i> Ask for refund for the remaining hours (If applicable)
                    </p>
                </div>
            </div>
            {{-- END PRO --}}

            {{-- ADVANCED --}}
            <div class="col-md-3 col-lg-3 col-sm-3 p-0 bg-white me-2 mb-2 border">
                <div class="container p-0 AdvancedHeadingContainer">
                    <p class="text-white text-center p-3 m-0 Heading">ADVANCED</p>
                </div>
                <div class="container packageDetails p-3 ">
                    <p class="text-center"><span class="numberOfLessons ">20</span><span
                            class="textLessons">Lessons</span></p>
                </div>
                <div class="container p-0">
                    <p class="text-center"><span class="themeColor">Teacher:
                        </span>{{ $teacherDetails->name }}
                    </p>
                    <p class="text-center" v-if="loaded"><span class="themeColor">Teacher's fee:
                        </span>${{ $teacherDetails->hourly_pay }}/hour</p>
                    <p class="text-center" v-if="loaded"><span
                            class="totalPrice">${{ floatval($teacherDetails->hourly_pay) * floatval(20) - floatval(10) }}</span>
                    </p>
                    <p class="text-center"><span class="themeColor">You save $10</span></p>
                </div>
                <div class="container p-0 d-flex justify-content-center">
                    <button class="buyBtn d-block text-center " id="buyHours">Buy Hours</button>
                    <input type="hidden" name="" value="5" id="LessonHours">
                    <input type="hidden" name="" id="LessonTotalFee"
                        value="{{ floatval($teacherDetails->hourly_pay) * floatval(20) - floatval(10) }}">
                </div>
                <div class="container packageBenefits p-3">
                    <p><i class="fa-solid fa-circle-check"></i> Transfer hours to another teacher if teacher doesn't
                        meet your needs.</p>
                    <p><i class="fa-solid fa-circle-check"></i> Ask for refund for the remaining hours (If applicable)
                    </p>
                </div>
            </div>
            {{-- END ADVANCED --}}
        </div>
        {{-- Packages --}}


        {{-- Modal --}}
        {{-- teacher id --}}
        <input type="hidden" name="" value="{{$teacherDetails->id}}" id="teacherId">
        {{-- end teacher id --}}
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-2"></div>
            <div class="col-md-2 col-lg-8 col-sm-8 p-4 mt-3">
                <p class="text-center">
                    You can also buy custom number of hours.
                </p>
                <div class="container p-0 d-flex justify-content-center">
                    <button type="button" class="btn customBtn" data-bs-toggle="modal"
                        data-bs-target="#customHours">Buy custom hours</button>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2"></div>
        </div>
        <!-- Lesson modal -->
        <div class="modal fade" id="customHours" tabindex="-1" aria-labelledby="customHours" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title text-center" id="customHours">Select number of hours suitable for you!</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container mb-4">
                            <p><span style="color:#029e20">Teacher: </span>{{ $teacherDetails->name }}</p>
                            <p><span style="color:#029e20">Teacher's fee:</span>
                                ${{ $teacherDetails->hourly_pay }}/hour</p>
                            <p v-if="loaded"><span style="color:#029e20">Total fee: </span><span style="font-size: 25px"
                                    id="displayTotalFee"></span></p>
                            <p>Number of lessons: <span id="displayLessonNumber" style="font-size: 23px"></span></p>
                        </div>
                        <div class="container mt-3">
                            <input type="range" min="1" max="100" value="10" class="slider"
                                id="numberOfCustomLesson">
                            <input type="hidden" value="{{ $teacherDetails->hourly_pay }}" id="teacherHourlyPay">
                            <input type="hidden" value="" id="calculatedTotalFee">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn buyCustomBtn" id="buyCustomBtn">Buy Hours</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Modal --}}
    </div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script>
    $(document).ready(function() {

        // setting the values
        $('#displayTotalFee').html('$' + $('#numberOfCustomLesson').val() * $('#teacherHourlyPay').val());
        $('#displayLessonNumber').html($('#numberOfCustomLesson').val());
        $('#numberOfCustomLesson').on('input', function() {
            $('#displayTotalFee').html('$' + $('#numberOfCustomLesson').val() * $('#teacherHourlyPay')
                .val());
            $('#displayLessonNumber').html($('#numberOfCustomLesson').val());
            $('#calculatedTotalFee').val($('#numberOfCustomLesson').val() * $('#teacherHourlyPay')
            .val());
        })
        // end of setting values

        $('#buyCustomBtn').click(() => {
            const data = {
                teacherId: $('#teacherId').val(),
                totalPrice: $('#numberOfCustomLesson').val() * $('#teacherHourlyPay').val(),
                booked_hours:  $('#numberOfCustomLesson').val() 
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            })
            $.ajax({
                url: "/student/paidHoursDetails",
                type: "POST",
                data: data,
                // async : false, 
                success: function(response, textStatus, jqXHR) {
                    // setTimeout(() => {
                        window.location = '/student/payforhours';
                    // }, 1000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        })
    })
</script>
</body>
</html>
<style>
    body {
        color: #183153;
        background: #F8F9FA
    }

    /* STARTER */

    .buyBtn {
        border: 1px solid #029e20;
        color: white;
        background: #029e02;
        padding: 2px 15px 4px;
        text-decoration: none;
        width: 75%;
    }

    .buyBtn:hover {
        background: #02ad25;
        color: white;
    }

    .totalPrice {
        font-size: 30px;
    }

    .numberOfLessons {
        font-size: 50px;
        font-weight: 550;
    }

    .textLessons {
        font-size: 25px;
        font-weight: lighter;
    }

    .Heading {
        font-size: 25px;
        font-weight: 550;
    }

    .StarterHeadingContainer {
        background: rgb(4, 128, 28);
        background: -moz-linear-gradient(90deg, rgba(4, 128, 28, 1) 0%, rgba(2, 158, 32, 1) 100%);
        background: -webkit-linear-gradient(90deg, rgba(4, 128, 28, 1) 0%, rgba(2, 158, 32, 1) 100%);
        background: linear-gradient(90deg, rgba(4, 128, 28, 1) 0%, rgba(2, 158, 32, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#04801c", endColorstr="#029e20", GradientType=1);
    }

    .ProHeadingContainer {
        background: rgb(240, 157, 6);
        background: -moz-linear-gradient(90deg, rgba(240, 157, 6, 1) 0%, rgba(255, 165, 0, 1) 100%);
        background: -webkit-linear-gradient(90deg, rgba(240, 157, 6, 1) 0%, rgba(255, 165, 0, 1) 100%);
        background: linear-gradient(90deg, rgba(240, 157, 6, 1) 0%, rgba(255, 165, 0, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#f09d06", endColorstr="#ffa500", GradientType=1);
    }

    .AdvancedHeadingContainer {
        background: hsla(51, 88%, 46%, 1);
        background: linear-gradient(90deg, hsla(51, 88%, 46%, 1) 0%, hsla(51, 100%, 50%, 1) 100%);
        background: -moz-linear-gradient(90deg, hsla(51, 88%, 46%, 1) 0%, hsla(51, 100%, 50%, 1) 100%);
        background: -webkit-linear-gradient(90deg, hsla(51, 88%, 46%, 1) 0%, hsla(51, 100%, 50%, 1) 100%);
        filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#DFC00E", endColorstr="#FFD800", GradientType=1);
    }

    .packageDetails {
        background-color: #f8f9fa;
    }

    .themeColor {
        color: #029e20;
    }

    .fa-circle-check {
        color: #029e20;
    }

    .buyCustomBtn {
        border: 1px solid #029e02;
        color: #029e02;
    }

    .buyCustomBtn:hover {
        background: #029e02;
        color: white;
    }

    .customBtn {
        border: 1px solid #029e02;
        background: #029e02;
        color: white;
        border-radius: 0;
    }

    .customBtn:hover {
        color: white;
        background: #03aa03;
    }

    /* END STARTER */
    .btn:focus {
        outline: none;
        box-shadow: none;
    }

    /* slider*/
    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 8px;
        background: #d0d3d1;
        border-radius: 5px;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        border-radius: 50%;
        appearance: none;
        width: 18px;
        height: 18px;
        background: #029e20;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 18px;
        border-radius: 50%;
        height: 18px;
        background: #029e20;
        cursor: pointer;
    }

    /* slider */

</style>
