<template>
    <div>
        <div class="container-jumbotron">
            <ul class="ToggleLinks">
                <li
                    class="d-flex justify-content-center justify-items-center"
                    @click="showLinks"
                >
                    <span class="Bars"><i class="fa-solid fa-bars"></i></span>
                </li>
            </ul>
            <ul class="smallScreenLeftNav">
                <span
                    ><i class="fa-solid fa-xmark" @click="closeLinks"></i
                ></span>
                <li>Calendar</li>
                <li>Find students</li>
                <li>Lesson Plan</li>
                <li>Lesson Plan</li>
                <li>Lesson Plan</li>
                <li>Lesson Plan</li>
                <li>Lesson Plan</li>
                <li>
                    <a href="/teacher/logout">
                        Logout
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </li>
            </ul>

            <div class="row">
                <div
                    class="col-md-6 col-sm-6 col-lg-6 d-flex justify-content-center"
                >
                    <ul>
                        <li class="LogoLink">
                            <img
                                src="/images/Logo.png"
                                alt="trenglish_logo"
                                class="LogoImg"
                            />
                        </li>
                    </ul>
                    <ul class="largeScreenLeftNav">
                        <li>Calendar</li>
                        <li>Find students</li>
                        <li>Lesson Plan</li>
                    </ul>
                </div>
                <div
                    class="col-md-6 col-sm-6 col-lg-6 d-flex justify-content-start"
                >
                    <ul class="largeScreenLeftNav">
                        <li><i class="fa-solid fa-message"></i></li>
                        <li><i class="fa-solid fa-bell"></i></li>
                        <li>Earnings <i class="fa-solid fa-wallet"></i></li>
                    </ul>
                    <ul class="largeScreenLeftNav">
                        <li></li>
                        <li>Profile</li>
                        <li class="logoutbtn">
                            <a href="/teacher/logout">
                                LOGOUT
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
    data() {
        return {};
    },
    mounted() {},
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
/* small screen css */
.fa-xmark {
    position: absolute;
    left: 20px;
    font-size: 35px;
    color: #a5aaa7;
}
.fa-xmark:hover {
    color: #029e20;
    cursor: pointer;
}
.smallScreenLeftNav {
    display: none;
    gap: 5px;
    flex: 1;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    font-size: 20px;
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
.smallScreenLeftNav li a {
    text-decoration: none;
    color: #183153;
}
.smallScreenLeftNav li a:hover {
    color: #029e20;
    font-size: 21px;
}
/* small screen css */


.largeScreenLeftNav {
    display: inline-flex;
    gap: 25px;
    flex: 1;
    flex-wrap: wrap;
}
.largeScreenLeftNav li {
    list-style: none;
    padding-top: 10px;
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
.logoutbtn a{
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
