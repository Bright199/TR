<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{-- @foreach ($teacher as $detail)
        {{ $detail->name }}
        @endforeach --}}
        {{ $teacherName }}
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

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container-jumbotron TopBar1">
        <div class="row">
            <div class="col">
                <ul class="NavLinks">
                    <li style="margin-left: 20px">
                        <a href="{{ url('/student/dashboard') }}">
                            <i class="fa-solid fa-house"></i>&nbsp;Dashboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul class="NavLinks2">
                    <li class="userdropdown">
                        <!-- <a href="" class="Logout "></a> -->
                        <a href="{{ url('/student/messages') }}">
                            <span class="UserName"><i class="fa-solid fa-message"></i>&nbsp;
                                Messages</span>
                        </a>
                        <ul class="userdropdown-content">
                            <li>
                                <a href="{{ url('/student/messages') }}">From: Teacher's name</a>
                            </li>
                            <hr />
                        </ul>
                    </li>
                    <li class="userdropdown">
                        <!-- <a href="" class="Logout "></a> -->
                        <a href="{{ url('/student/teachers') }}">
                            <span class="UserName"><i class="fa-solid fa-chalkboard-user"></i>&nbsp;
                                Teachers</span>
                        </a>
                    </li>
                    <li class="userdropdown">
                        <!-- <a href="" class="Logout "></a> -->
                        <a href="{{ url('/student/favorite') }}">
                            <span class="UserName"><i class="fa-solid fa-bookmark"></i>&nbsp;
                                My favorites</span>
                        </a>
                        <ul class="userdropdown-content">
                            <li>
                                <a href="{{ url('/student/favorite') }}">Teacher's name</a>
                            </li>
                            <hr />
                        </ul>
                    </li>
                    <li class="userdropdown">
                        <!-- <a href="" class="Logout "></a> -->
                        <span class="UserName">{{ Auth::guard('student')->user()->name }}</span>
                        <ul class="userdropdown-content">
                            <li>
                                <p>
                                    Account&nbsp;<i class="fa-solid fa-gear" style="
                                            color: #151419;
                                            font-size: 20px;
                                        "></i>
                                </p>
                            </li>
                            <hr />
                            <li>
                                <a href="{{ url('/student/edit/profile') }}">View Profile</a>
                            </li>
                            <li>
                                <a href="{{ url('/student/ad/management') }}">My ads</a>
                            </li>
                            <li>
                                <a href="/student/logout">Logout
                                    <i class="fa-solid fa-right-from-bracket" style="
                                            color: #151419;
                                            font-size: 20px;
                                        "></i></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4 ">
                        <img src="{{ asset('images/Green2.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-md-8 border shadow-sm">
                        <h3>{{ $teacherName }}
                            &nbsp;<i class="fa-solid fa-shield-blank" style="color:#029e02; font-size:18px"></i>
                        </h3>
                        <p>{{ $teacherDescription }}</p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9 d-flex justify-content-end">
                                    <p>
                                        Speaks {{ $teacherFirstLang }} <span class="MainFluencyLevel" style="font-weight:500;
                                           ">{{ $teacherFirstLangProf }}</span>
                                        {{ $teacherSecondLang }}
                                        <span class="FluencyLevel" style="font-weight:500; ">{{
                                            $teacherSecondLangProf }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if ($isOurTeacher === 1)
                        <p>Works for <span style="font-weight: 500; color:#029e02">TREnglish </span> </p>
                        @endif
                        <p style="font-weight:700; font-size:16px"><i class="fa-solid fa-dollar-sign"></i>{{
                            $teacherHourlyPay }} USD /hour</p>
                        <p>Joined on {{ date('d-m-Y', strtotime($teacherJoinedAt)) }}</p>
                        <p>{{ $teacherNationality }}</p>

                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-3">
                <!-- Button to Open the Modal -->
                <a href="#" class="hireBtn" data-bs-toggle="modal" data-bs-target="#MessageModal">
                    Hire {{explode(' ',$teacherName)[0]}} {{substr($teacherName,0,1)}}
                </a>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="MessageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title">Messaging {{explode(' ',$teacherName)[0]}} {{substr($teacherName,0,1)}}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <textarea class="form-control" rows="5" id="userMessage" name="text"
                        placeholder='Message...'></textarea>
                    <input type="hidden" name="" id="userId" value="{{$teacherId}}">
                </div>

                <!-- Modal footer -->
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel hiring</button>
                </div> --}}
                <div class="container d-flex justify-content-center">
                    <button class="SendBtn" id="SendMessage">Send message</button>
                </div>

            </div>
        </div>
    </div>

</html>
<script src="{{ mix('js/app.js') }}" defer></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
       $('#SendMessage').click(function(e){
         const message = $('#userMessage').val().trim();
         if(message == ''){
            alert('message empty')
            return
         }
         else{
             const userDetails = {
                 message: message,
                 teacherId: $('#userId').val()
             }
                $.ajax({
                    url : "/student/message",
                    type: "POST", 
                    data : userDetails, 
                    // async : false, 
                    success: function(response, textStatus, jqXHR) {
                        $('#userMessage').val('')
                        window.location  = '/student/messages'
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                      
                        console.log(errorThrown);
                    }
                });
         }
       })
    })
</script>

<style >
    .SendBtn {
        /* padding: 4px 15px; */
        width: 50%;
        border: 1px solid #029e02;
        color: #029e02;
        margin-bottom: 14px;
        font-size: 20px;
        background-color: white
    }

    .SendBtn:hover {
        color: white;
        background-color: #029e02
    }

    .btn {
        border-radius: 0;
    }

    .TopBar1 {
        box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
        -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
        -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
        background-color:#fec107
    }

    .fa-solid {
        color: #151419;
    }

    .NavLinks2 {
        display: flex;
        padding: 10px;
        flex-direction: row;
        /* background-color: #fec107; */
        justify-content: flex-end;
    }

    .NavLinks2 li {
        list-style: none;
        margin-right: 25px;
        font-size: 20px;
    }

    .NavLinks2 li a {
        text-decoration: none;
        color: #151419;
    }

    .NavLinks {
        display: flex;
        padding: 10px;
        flex-direction: row;
        /* background-color: #fec107; */
        justify-content: flex-start;
    }

    .NavLinks li {
        list-style: none;
        margin-right: 25px;
        font-size: 20px;
    }

    .NavLinks li a {
        text-decoration: none;
        color: #151419;
    }

    .LinkItem {
        font-size: 18px;
        color: #151419;
        padding: 2px 10px;
    }

    .userdropdown {
        position: relative;
        /* display: inline-block; */
    }

    .userdropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 220px;
        box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.1);
        padding: 12px 16px;
        z-index: 1;
        right: -10px;
        /* top: 50px; */
    }

    .userdropdown-content a {
        color: #fec107;
        font-size: 18px;
    }

    .userdropdown-content a:hover {
        color: #fec107;
        /* font-size: 14px; */
    }

    .userdropdown:hover .userdropdown-content {
        display: block;
    }

    .UserName {
        color: #151419;
        text-transform: capitalize;
        font-weight: 600;
    }

    .UserName:hover {
        cursor: pointer;
    }

    .hireBtn {
        text-decoration: none;
        font-size: 15px;
        background-color: #fec107;
        color: #151419;
        padding: 10px;
    }

    .hireBtn:hover {
        color: #151419;
        background-color: #f0b608;
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

    textarea {
        resize: none;
    }

    #userMessage:focus {
        box-shadow: none;
        outline: none;
        border: 1px solid #029e02
    }
</style>