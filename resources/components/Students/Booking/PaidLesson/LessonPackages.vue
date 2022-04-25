<template>
    <div>
        <div class="container-jumbotron bg-white">
            <Header />
        </div>
        <div class="spinner" v-if="loading">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
        <div class="p-4" v-if="teacherExist.length">
            <div class="container bg-light p-4" v-if="loaded">
                <p class="text-center">
                    Seems you still have some hours with this teacher.
                </p>
                <p class="text-center">
                   You can only book extra hours after completing the hours you have with this teacher.
                </p>
                <div class="container ">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <router-link
                                    to="/student/all/booked/lessons"
                                    class="myLesson text-center"
                                    >My Lessons</router-link
                                >
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4" v-else>
            <div v-if="loaded">
                <div class="row bg-white p-4 d-flex justify-content-center">
                <Starter :userId="id" />
                <Pro :userId="id" />
                <Advanced :userId="id" />
            </div>
            <CustomNumberOfLesson :userId="id" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "../../Edits/Header.vue";
import Advanced from "./Advanced.vue";
import CustomNumberOfLesson from "./CustomNumberOfLesson.vue";
import Pro from "./Pro.vue";
import Starter from "./Starter.vue";
export default {
    props: ["id"],
    data() {
        return {
            teacherExist: '',
            loading: false,
            loaded: false,
        };
    },
    components: { Header, Starter, Pro, Advanced, CustomNumberOfLesson },
    mounted() {
        this.getThisTeacherLessonDetails();
    },
    methods: {
        getThisTeacherLessonDetails() {
            this.loading = true;
            axios
                .get("/student/getThisTeacherLessonDetails/" + this.id)
                .then((response) => {
                    this.teacherExist = response.data;
                    this.loaded = true
                }).finally(()=>{
                    this.loading = false
                });
        },
    },
};
</script>

<style>
.myLesson {
    text-decoration: none;
    padding: 5px 15px 8px;
    border-radius: 3px;
    color: white;
    background: #029e02;
}

.myLesson:hover {
    color: white;
    background: #02ac02;
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
