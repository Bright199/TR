<template>
    <div class="bg-light">
        <DashboardNavBar />
        <div class="container p-3">
            <div class="spinner" v-if="loading == true">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <div class="container" v-if="loaded && lessonDetails.length">
                <div class="row">
                    <div
                        class="col-md-3 p-3 mb-2 me-2 bg-white shadow-sm"
                        style="height: 310px; overflow-y: auto"
                    >
                        <div class="row Avatar">
                            <div class="container d-flex justify-content-center justify-items-center">
                                <img v-if="lessonDetails[0].teacher_image"  class="rounded-circle" :src="'/images/' + lessonDetails[0].teacher_image" alt="profile_image" width="75" height="75" />
                                <img v-else class="rounded-circle" src="/images/avatar.png" alt="profile_image" width="75" height="75"/>
                            </div>
                            <p class="text-center" style="margin-bottom: 2px"> {{ lessonDetails[0].teacher_name }}</p>
                            <p class="text-center" style="color: #029e02">{{lessonDetails[0].teacher_teaching_language}}</p>
                            <div class="container px-3 border-top pt-2">
                                <p v-if="lessonDetails[0].teacher_online === 1" style="margin-top: 2px; margin-bottom: 2px"><span>Online <i class="fa-solid fa-circle" style="color: #029e20; font-size: 12px"></i></span></p>
                                <p v-else style="margin-top: 2px; margin-bottom: 2px">Online <i class="fa-solid fa-circle" style="font-size: 12px"></i></p>
                                <p style="margin-top: 2px; margin-bottom: 2px">Hourly fee: <span style="color: #029e20">${{lessonDetails[0].teacher_hourly_pay}}</span></p>
                                <p style="margin-top: 2px; margin-bottom: 2px">From: <span style="color: #029e20">{{lessonDetails[0].teacher_nationality}}</span></p>
                            </div>
                            <div class="container d-flex justify-content-end ">
                                <button class="MessageBtn" data-bs-toggle="modal" data-bs-target="#MessageModal">
                                 <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6 mb-2 bg-white shadow-sm p-4">
                        <!-- status -->
                        <p v-if="lessonDetails[0].booked === 0">
                            Status:
                            <span style="color: red">Booking not complete</span>
                        </p>
                        <p v-if="lessonDetails[0].booked === 1">
                            <span style="color: #029e20"
                                >Booked <i class="fa-solid fa-check"></i
                            ></span>
                        </p>
                        <p
                            v-if="
                                lessonDetails[0].lesson_completed === 0 &&
                                lessonDetails[0].booked === 1
                            "
                        >
                            Status :<span style="color: blue"
                                >You haven't attended this lesson yet!</span
                            >
                        </p>
                        <p v-if="lessonDetails[0].lesson_completed === 1">
                            Status :<span style="color: #029e20"
                                >Lesson completed!</span
                            >
                        </p>
                        <!-- end of lesson status -->
                        <hr />
                        <!-- Time details -->
                        <div class="row">
                            <div class="col-md-4">
                                <img
                                    src="/images/clock.png"
                                    alt=""
                                    width="100"
                                />
                            </div>
                            <div class="col-md-8">
                                <p style="margin-bottom: 2px">
                                    Date: {{ timeDate(lessonDetails[0].date) }}
                                </p>
                                <p>
                                    Time: {{ lessonDetails[0].timeslot }}
                                    {{ timeZone() }}
                                </p>
                            </div>
                        </div>
                        <!--end time -->
                        <hr />
                        <div class="container p-0">
                            <!-- Lesson link -->
                            <a
                                class="JoinLesson"
                                href=""
                                target="_blank"
                                v-if="lessonDetails[0].booked === 1"
                                >Join Lesson</a
                            >
                            <!-- end lesson link -->

                            <router-link
                                v-if="lessonDetails[0].booked === 0"
                                to="/student/incomplete/demo/booking"
                                style="
                                    background: #029e02;
                                    color: white;
                                    padding: 0px 15px 5px;
                                    text-decoration: none;
                                    float: right;
                                "
                                >Book demo lesson</router-link
                            >
                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <router-link to="/student/all/booked/lessons" class="MyLesson">My Lessons</router-link>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="container" v-if="loaded">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-7 bg-white p-3">
                            <h4 class="text-center">No results</h4>
                            <div
                                class="container d-flex justify-content-center"
                            >
                                <img
                                    src="/images/sad.png"
                                    alt=""
                                    width="200"
                                    class=""
                                />
                            </div>
                            <p class="text-center">
                                Book a lesson wth our teachers
                            </p>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <router-link
                                to="/student/dashboard"
                                class="BrowseTeachers"
                                style="background: #029e20"
                                >Book a teacher</router-link
                            >
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal -->
            <div class="modal fade" id="MessageModal" v-if="lessonDetails.length">
                <div
                    class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                >
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <p class="modal-title" >
                                <i class="fa-solid fa-message" style="color: #029e02"></i>
                                {{ lessonDetails[0].teacher_name }}
                            </p>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                id="close"
                            ></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="userMessage"
                                    v-model="message"
                                    name="message"
                                    placeholder="Write your message here..."
                                />
                                <button
                                    type="submit"
                                    class="SendBtn"
                                    @click="
                                        SendMessage(lessonDetails[0].teacher_id)
                                    "
                                >
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Modal footer -->
                    </div>
                </div>
            </div>
            <!-- end of modal -->
    </div>
</template>

<script>
import axios from "axios";
import DashboardNavBar from "../DashboardNavBar.vue";
import moment from "moment-timezone";
export default {
    name: "SingleDemoLesson",
    components: {
        DashboardNavBar,
    },
    props: ["id"],
    data() {
        return {
            lessonDetails: "",
            loading: false,
            loaded: false,
            message: "",
        };
    },
    methods: {
        SendMessage(teacherId) {
            const message = this.message.trim();
            if (message == "") {
                alert("Message empty");
                return;
            } else if (teacherId == "") {
                alert("select a teacher");
                return;
            } else {
                axios
                    .post("/student/message", { message, teacherId })
                    .then((response) => {
                        alert('Message sent successfully!')
                        // this.$el.querySelector("#close").click();
                    })
                        this.message = "";
            }
        },
        timeZone() {
            return moment.tz.guess();
        },
        timeDate(v) {
            return moment(v).format("MMMM Do YYYY");
        },
        getSingleDemoLessonDetails() {
            this.loading = true;
            axios
                .get("/student/getSingleDemoLessonDetails" + this.id)
                .then((result) => {
                    this.lessonDetails = result.data;
                    console.log(result);
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    mounted() {
        this.getSingleDemoLessonDetails();
    },
};
</script>
<style scoped>
.MyLesson{
    border: 1px solid #029e02;
    border-radius: 3px;
    text-decoration: none;
    color: #183153;
    padding: 2px 10px 5px;
    margin: 8px auto;
    display: flex;
    justify-content: center;
}
.SendBtn {
    border: none;
    background-color: #029e02;
    color: white;
    padding: 3px 10px 5px;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}
.SendBtn:hover {
    border: none;
    color: white;
    background-color: #04ad04;
}
.MessageBtn{
    border: 1px solid #029e02;
    border-radius: 50%;
    background: white;
    width: 40px;
    height: 40px;
}
.MessageBtn i{
    color: #029e02;
}
.MessageBtn:hover{
    background-color: #029e02;
}
.MessageBtn:hover i{
    color: white;
}
.JoinLesson{
    text-decoration:none;
    padding: 2px 15px 5px;
    background-color: #029e02;
    color: white;
    border-radius: 3px;
    float: right;
}
.JoinLesson:hover{
    background-color: #03b103;
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

/* img {
    width: 100px;
} */

.Avatar img {
    border-radius: 50%;
}
/* .Avatar{
    height: 150px;
} */
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
</style>
