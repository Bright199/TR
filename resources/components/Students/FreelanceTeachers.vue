<template>
    <div>
        <DashboardNavBar />
        <div class="container">
            <div class="row">
                <div class="col-md-3 me-3 mt-4 shadow-sm LeftBar">
                    <router-link to="/student/teachers"
                        >Our teachers</router-link
                    >
                    <router-link
                        to="/student/freelance/teachers"
                        style="background-color: #029e02; color: white"
                        >Freelance teachers</router-link
                    >
                </div>
                <div class="col-md-8 mb-4 mt-4 shadow-sm">
                    <div class="container-jumbotron border-bottom pt-3 ps-3">
                        <p>
                            <span
                                style="
                                    font-size: 25px;
                                    font-weight: 550;
                                    margin-top: 8px;
                                "
                                >Top results &nbsp;</span
                            >
                            <span v-if="teachers.to"
                                >Showing {{ teachers.to }} of
                                {{ teachers.total }} freelance teachers</span
                            >
                        </p>
                    </div>
                    <div v-if="teachers.total >0" class="TeachersContainer">
                        <div
                            v-for="(teacher, index) in teachers.data"
                            :key="index"
                        >
                            <a
                                :href="'/student/freelance/single/teacher/' + teacher.id"
                                class="teacherDetailsLink"
                            >
                                <div class="row teacherDetails">
                                    <div class="col-md-4">
                                        <img
                                            src="/images/Green2.png"
                                            alt=""
                                            width="150"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <h3>
                                            {{ teacher.name }}
                                        </h3>
                                        <p>{{ teacher.description }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="/student/dashboard"
                                            >Hire {{ teacher.name }}</a
                                        >
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div v-else>
                        <div class="spinner" v-if="loading2 == true">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                        <div class="contnainer py-5" v-if="loaded == true">
                            <h4 class="d-flex justify-content-center " >
                                Check our teachers
                            </h4>
                            <p class="d-flex justify-content-center ">Currently freelance teachers are unavailable</p>
                        </div>
                    </div>
                    <div class="container">
                        <Pagination
                            :data="teachers"
                            align="center"
                            @pagination-change-page="getFreelanceTeachers"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import DashboardNavBar from "./DashboardNavBar.vue";
import LaravelVuePagination from "laravel-vue-pagination";
export default {
    name: "Teachers",
    components: {
        DashboardNavBar,
        Pagination: LaravelVuePagination,
    },
    data() {
        return {
            teachers: {},
            loading2: false,
            loaded: false,
        };
    },
    mounted() {
        this.getFreelanceTeachers();
    },
    methods: {
        getFreelanceTeachers(page = 1) {
            window.scrollTo(0, 0);
            this.loading2 = true;
            axios
                .get("/student/other/teachers?page=" + page)
                .then((response) => {
                    this.teachers = response.data;
                    if (response.data.data.length === 0) {
                        this.loaded = true;
                    }
                })
                .finally(() => {
                    this.loading2 = false;
                   
                });
        },
    },
};
</script>
<style scoped>
.LeftBar {
    height: 250px;
}
.LeftBar :first-child{
    margin-top: 15px
}
.LeftBar a {
    /* background-color: #029e02; */
    padding: 5px;
    color: #151419;
    display: block;
    text-align: center;
    width: 80%;
    margin: auto;
    margin-bottom: 10px;
    text-decoration: none;
    /* color: white; */
    font-size: 20px;
    border: 1px solid #029e02;
}
.LeftBar a:hover {
    background-color: #029e02;
    color: white;
}
.teacherDetails {
    border-bottom: 1px solid rgb(207, 205, 205);
    margin-left: 3px;
    padding: 15px;
}
.teacherDetails:hover {
    background-color: rgba(185, 185, 185, 0.1);
}
.teacherDetailsLink {
    color: #151419;
    text-decoration: none;
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
.TeachersContainer {
    height: 700px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
