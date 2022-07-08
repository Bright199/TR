<template>
    <div>
        <div class="container-jumbotron p-1">
            <ul class="ToggleLinks">
                <li class="d-flex justify-content-center justify-items-center" @click="showLinks">
                    <span class="Bars"><i class="fa-solid fa-bars"></i></span>
                </li>
            </ul>
            <ul class="smallScreenLeftNav">
                <span><i class="fa-solid fa-xmark" @click="closeLinks"></i></span>
                <li>
                    <router-link to="/teacher/calendar" >
                        My Calendar 
                    </router-link>
                </li>
                <li>
                    <router-link to="/teacher/find-students">
                        Find Students
                    </router-link>
                </li>
                <li>
                    <router-link to="/teacher/find-tutors">
                        Find Tutors
                    </router-link>
                </li>
                <li>
                    <router-link to="/teacher/lesson-plan">
                        Lesson Plan
                    </router-link>
                </li>
                <li class="notifications-links">
                    <ul>
                        <li><i class="fa-solid fa-message"></i></li>
                        <li><i class="fa-solid fa-bell"></i></li>
                        <li><i class="fa-solid fa-wallet"></i></li>
                    </ul>
                </li>
                <li class="logout">
                    <a href="/teacher/logout">
                        Logout
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 d-flex justify-content-center ">
                    <router-link to="/teacher/dashboard">
                        <img src="/images/Logo.png" alt="trenglish_logo" class="LogoImg" />
                    </router-link>
                    
                    <ul class="largeScreenLeftNav px-3">
                        <li :class="calendarComponent?'calendarComponent':''">
                            <router-link to="/teacher/calendar" >My Calendar</router-link>
                        </li>
                        <li :class="findStudentsComponent?'findStudentsComponent':''">
                            <router-link to="/teacher/find-students">Find Students</router-link>
                        </li>
                        <li :class="findTutorsComponent?'findTutorsComponent':''">
                            <router-link to="/teacher/find-tutors">Find Tutors</router-link>
                        </li>
                        <li :class="lessonPlanComponent?'lessonPlanComponent':''">
                            <router-link to="/teacher/lesson-plan">Lesson Plan</router-link>
                        </li>

                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 d-flex justify-content-start">
                    <ul class="largeScreenLeftNav">
                        <li><i class="fa-solid fa-message"></i></li>
                        <li><i class="fa-solid fa-bell"></i></li>
                        <li>
                            <router-link to="/teacher/teacher-earnings" class="dropdown-toggle">
                                {{ 200 }} USD 
                            <i class="fa-solid fa-wallet"></i>
                            </router-link>

                        </li>
                    </ul>
                    <ul class="largeScreenLeftNav justify-content-end pe-2">
                        <li>
                            <router-link to="/teacher/profile-edit">
                                Profile
                            </router-link>
                        </li>
                        <li class="logoutbtn">
                            <a href="/teacher/logout">
                                Logout
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "RegisterNav",
    props:['calendarComponent','findStudentsComponent','findTutorsComponent','lessonPlanComponent'],
    data() {
        return {};
    },
    mounted() { },
    methods: {
        showLinks() {
            document.querySelector(".smallScreenLeftNav").style.display =
                "flex";
        },
        closeLinks() {
            document.querySelector(".smallScreenLeftNav").style.display =
                "none";
        },
    },
};
</script>

<style scoped>
.findStudentsComponent a{
    border:1px solid #029e02 !important;
    padding: 7px 10px 8px;
    border-radius: 5px;
    color: #029e02 !important;
}
.lessonPlanComponent a{
    border:1px solid #029e02 !important;
    padding: 7px 10px 8px;
    border-radius: 5px;
    color: #029e02 !important;
}
.findTutorsComponent a{
    border:1px solid #029e02 !important;
    padding: 7px 10px 8px;
    border-radius: 5px;
    color: #029e02 !important;
}
.calendarComponent a{
    border:1px solid #029e02 !important;
    padding: 7px 10px 8px;
    border-radius: 5px;
    color: #029e02 !important;
}


/* small screen css */
.fa-xmark {
    position: absolute;
    right: 20px;
    font-size: 35px;
    color: #a5aaa7;
}

.fa-xmark:hover {
    color: #029e20;
    cursor: pointer;
}

.notifications-links ul {
    display: flex;
    gap: 10px;
    padding: 0;
    margin: 0;
}

.smallScreenLeftNav {
    display: none;
    gap: 5px;
    flex: 1;
    flex-wrap: wrap;
    flex-direction: column;
    padding: 20px;
    width: 100%;
    height: 100%;
    top: 0;
    bottom: 0;
    left: 0;
    position: absolute;
    z-index: 2;
    background: white;
    transition: 0.5s;
}

.smallScreenLeftNav li {
    list-style: none;
}

.smallScreenLeftNav .logout a {
    color: #029e20;
}

.smallScreenLeftNav li a {
    text-decoration: none;
    color: #183153;
}

.smallScreenLeftNav li a:hover {
    color: #029e20;
}

/* small screen css */


.largeScreenLeftNav {
    display: inline-flex;
    gap: 25px;
    flex: 1;
    flex-wrap: wrap;
    padding: 0;
}

.largeScreenLeftNav li {
    list-style: none;
    padding-top: 10px;
}

.largeScreenLeftNav li a{
    text-decoration: none;
    color: #183153;
}
.largeScreenLeftNav li a:hover{
    color: #029e20;
}

/*  */
.LogoImg {
    margin-right: 12px;
    width: 45px;
    height: 45px;
}

.LogoLink {
    padding: 0px;
    list-style: none;
    border-right: 2px solid #eae9ec;
}

/*  */
.ToggleLinks {
    display: none;
    position: absolute;
    top: 40px;
    right: 20px;
    font-size: 25px;
}

.ToggleLinks li {
    list-style: none;
}

.ToggleLinks li span:hover {
    cursor: pointer;
    color: #029e02;
}

/*  */

/*  */
.logoutbtn a {
    text-decoration: none;
    color: #029e20
}



/*  */
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (max-width: 768px) {
    .LogoLink {
        border-right: 0;
    }

    .LogoImg {
        margin-right: 12px;
        width: 95px;
        height: 95px;
    }

    .largeScreenLeftNav {
        display: none;
    }

    .ToggleLinks {
        display: flex;
    }
}

/* spinner */
.spinner {
    margin: 100px auto;
    width: 40px;
    height: 40px;
    position: relative;
    text-align: center;

    -webkit-animation: sk-rotate 2s infinite linear;
    animation: sk-rotate 2s infinite linear;
}

.dot1,
.dot2 {
    width: 60%;
    height: 60%;
    display: inline-block;
    position: absolute;
    top: 0;
    background-color: #029e02;
    border-radius: 100%;

    -webkit-animation: sk-bounce 2s infinite ease-in-out;
    animation: sk-bounce 2s infinite ease-in-out;
}

.dot2 {
    top: auto;
    bottom: 0;
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

@-webkit-keyframes sk-rotate {
    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes sk-rotate {
    100% {
        transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
    }
}

@-webkit-keyframes sk-bounce {

    0%,
    100% {
        -webkit-transform: scale(0);
    }

    50% {
        -webkit-transform: scale(1);
    }
}

@keyframes sk-bounce {

    0%,
    100% {
        transform: scale(0);
        -webkit-transform: scale(0);
    }

    50% {
        transform: scale(1);
        -webkit-transform: scale(1);
    }
}

/*  */
</style>
