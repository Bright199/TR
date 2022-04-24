<template>
    <div class="col-md-9 mb-2 me-2 shadow-sm bg-white p-2">
        <div class="container-jumbotron border-bottom p-3">
            <h5 class="text-center">Here are all your trial lessons.</h5>
        </div>
        <div class="container">
            <div class="spinner" v-if="loading == true">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <table
                class="table table-responsive table-striped table-sm table-hover"
                v-if="demoLessons.length"
            >
                <tr v-for="lesson in demoLessons" :key="lesson" class="p-5">
                    <td><span style="color: #029e20">Date:</span> {{ dateTime(lesson.date) }}</td>
                    <td><span style="color: #029e20">Time:</span> {{ lesson.timeslot }}</td>
                    <td>
                        <span v-if="lesson.lesson_completed === 1"
                            >Status:
                            <img src="/images/tick.png" alt="" width="20"
                        /></span>
                        <span v-else
                            >Status:
                            <span class="text-primary">unattended</span>
                        </span>
                    </td>
                    <td>
                        <router-link :to="'/student/view/demo/lesson'+lesson.id"
                            class="viewDetails">View Details</router-link
                        >
                    </td>
                </tr>
            </table>
            <div v-else class="container">
                <div class="contnainer py-5" v-if="loaded == true">
                    <span class="d-flex justify-content-center">
                        <img src="/images/profiles.png" alt="" width="210" />
                    </span>
                    <h4 class="d-flex justify-content-center">
                        No booked demo lessons yet
                    </h4>
                    <p class="d-flex justify-content-center">
                        You can book your first lesson so easily by accessing
                        the teacher's section.
                    </p>
                    <router-link to="/student/teachers" class="BrowseTeachers"
                        >Browse Teachers</router-link
                    >
                </div>
            </div>
        </div>
        <!-- {{demoLessons}} -->
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
    name: "DemoLists",
    data() {
        return {
            demoLessons: "",
            loading: false,
            loaded: false,
        };
    },
    mounted() {
        this.getAllBookedDemoLessons();
    },
    methods: {
        dateTime(value) {
            return moment(value).format("dddd, MMMM Do");
            // moment(value).startOf().fromNow()
        },
        getAllBookedDemoLessons() {
            this.loading = true;
            axios
                .get("/student/getAllBookedDemoLessons/")
                .then((response) => {
                    this.demoLessons = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style scoped>
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
.BrowseTeachers {
    background-color: #029e02;
    padding: 5px 0px 7px;
    color: white;
    display: block;
    text-align: center;
    width: 50%;
    margin: auto;
    margin-bottom: 10px;
    text-decoration: none;
    /* color: white; */
    font-size: 20px;
    border: 1px solid #029e02;
}
.BrowseTeachers:hover {
    background-color: #02ad02;
}
.viewDetails{
    text-decoration: none;
    background-color: #029e02;
    color: white;
    border-radius: 3px;
}
</style>
