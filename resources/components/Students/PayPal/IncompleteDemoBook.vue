<template>
    <div>
        <div class="container-jumbotron shadow-sm py-3">
            <div class="row m-0 p-0">
                <div class="col-md-4 ms-3">
                    <router-link to="/student/dashboard" class="DashboardClass">
                        <i class="fa-solid fa-angle-left"></i>
                        &nbsp;Dashboard
                    </router-link>
                </div>
            </div>
        </div>

        <div class="container-jumbotron p-3 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 bg-white LeftBar">
                        <div class="container border-bottom p-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <img
                                        src="/images/checklist.png"
                                        alt=""
                                        class="d-flex justify-content-center"
                                        width="60"
                                    />
                                </div>
                                <div class="col-md-9">
                                    <p>Incomplete booking</p>
                                </div>
                            </div>
                        </div>
                            <div class="spinner" v-if="loading == true">
                                <div class="dot1"></div>
                                <div class="dot2"></div>
                            </div>
                        <div
                            class="container p-2"
                            v-if="allIncompleteDemoBooking.length"
                        >
                            <ul class="teachersList" v-if="loaded== true">
                                <li
                                    v-for="(
                                        teacher, index
                                    ) in allIncompleteDemoBooking"
                                    :key="index"
                                >
                                    <div class="row teacherDetails">
                                        <div
                                            class="col-md-4 d-flex justify-content-end ms-0 me-0 pt-2"
                                        >
                                            <img
                                                v-if="teacher.teacher_image"
                                                :src="
                                                    '/images/' +
                                                    teacher.teacher_image
                                                "
                                                alt=""
                                                width="50"
                                                height="50"
                                                class=""
                                            />
                                            <img
                                                v-else
                                                src="/images/avatar.png"
                                                alt=""
                                                width="50"
                                                height="50"
                                            />
                                        </div>
                                        <div class="col-md-8 pt-2">
                                            <a
                                                :href="
                                                    '/student/book/demo/payment/' +
                                                    teacher.id
                                                "
                                                class="d-flex justify-content-start teacherName"
                                                >{{ teacher.name }}</a
                                            >
                                            <p
                                                class="d-flex justify-content-start teacherLanguage"
                                            >
                                                {{ teacher.first_language }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="container p-4" v-else>
                            <p class="d-flex justify-content-center" v-if="loaded== true">
                                No incomplete record
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <!-- bg-white MainContainer -->
                        <!-- <p
                            style="color: #b6b5b5"
                            class="d-flex justify-content-center"
                        >

                            Incomplete demo lesson booking
                        </p> -->
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "IncompleteDemoBook",
    data() {
        return {
            allIncompleteDemoBooking: "",
            loading: false,
            loaded: false,
        };
    },
    methods: {
        incompleteDemoBook() {
            this.loading = true
            axios
                .get("/student/incomplete/demo/lessons")
                .then((result) => {
                    this.allIncompleteDemoBooking = result.data;
                    this.loaded = true
                })
                .finally(() => {
                    this.loading = false
                });
        },
    },
    mounted() {
        this.incompleteDemoBook();
    },
};
</script>

<style scoped>
.DashboardClass {
    font-size: 18px;
    color: #151419;
    text-decoration: none;
}
.MainContainer {
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
}
.LeftBar {
    margin-bottom: 5px;
    margin-right: 10px;
}
.teachersList {
    overflow-y: auto;
    height: 350px;
    margin: 0;
    padding: 2px;
}
.teachersList li {
    list-style: none;
}
.teachersList li img {
    border-radius: 50%;
    padding: 2px;
    border: 1px solid #029e02;
}
.teacherName {
    margin-bottom: 0px;
    text-decoration: none;
    color: #029e02;
}

.teacherLanguage {
    margin-top: 0;
    font-size: 12px;
}

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
