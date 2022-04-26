<template>
    <div>
        <!-- <button @click="on">Turn on overlay effect</button> -->
        <div class="overlay">
            <div class="container Main">
                <div class="container p-3">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7 bg-white p-4 TeachersContainer">
                            <h5 class="text-center">
                                Learn from
                                <span style="color: #029e20">World class</span>
                                teachers on TREnglish.
                            </h5>
                            <div class="spinner" v-if="loading == true">
                                <div class="dot1"></div>
                                <div class="dot2"></div>
                            </div>
                            <span
                                ><i class="fa-solid fa-xmark" @click="off"></i
                            ></span>
                            <div v-if="allTrialContactTeachers.length">
                                <div
                                    class="row border-top mb-2 Details"
                                    v-for="teacher in allTrialContactTeachers"
                                    :key="teacher"
                                >
                                    <div class="col-md-6">
                                      <div class="row">
                                           <div class="col-md-3 d-flex justify-content-center justify-items-center">
                                           <img v-if="teacher.teacher_image !== null" :src="'/images/'+ teacher.teacher_image" alt="profile_image" class="rounded-circle" width="65" height="65">
                                           <img v-else src="/images/avatar.png" alt="profile_image" class="rounded-circle" width="65" height="65">
                                       </div>
                                       <div class="col-md-9 d-flex justify-content-center justify-items-center">
                                           <p class="pt-3">{{teacher.teacher_name}}</p>
                                       </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 p-3 d-flex justify-content-center justify-items-center">
                                                <p style="color: #029e20">${{teacher.hourly_pay}}/hour</p>
                                            </div>
                                            <div class="col-md-8 p-3 d-flex justify-content-center justify-items-center">
                                                <a :href="'/student/book/paid/lesson/'+teacher.teacher_id" v-if="teacher.is_booked_by_student === 1" class="BookingBtns">Buy hours</a>
                                                <a :href="'/student/book/demo/lesson/'+teacher.teacher_id" v-else class="BookingBtns">Book trial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container p-2 " v-else>
                                <div v-if="loaded" class="border-top">
                                    <div
                                        class="container d-flex justify-content-center pt-2"
                                    >
                                        <img
                                            src="/images/contacts.png"
                                            alt="contact"
                                        />
                                    </div>
                                    <p class="text-center">
                                        Seems you haven't booked a trial lesson
                                        or contacted any teacher yet!
                                    </p>
                                    <router-link
                                        to="/student/teachers"
                                        class="ContactBtn"
                                        >Contact some teachers for trial
                                        lesson.</router-link
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "BookPaidLesson",
    data() {
        return {
            loading: false,
            loaded: false,
            allTrialContactTeachers: "",
        };
    },
    methods: {
        off() {
            // document.querySelector(".overlay").style.display = "none";
            this.$store.commit({
                type: "closeBookPaidLessonComponent",
            });
        },
        getAllTrialContactTeachers() {
            this.loading = true;
            axios
                .get("/student/getAllTrialContactTeachers")
                .then((response) => {
                    this.allTrialContactTeachers = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    mounted() {
        this.getAllTrialContactTeachers();
    },
};
</script>

<style scoped>
.BookingBtns{
    text-decoration: none;
    background: #029e02;
    color:  white;
    padding:6px 15px 2px;
    border-radius: 4px;
}
.ContactBtn {
    text-decoration: none;
    padding: 2px 15px 5px;
    color: white;
    background: #029e02;
    margin: auto;
    display: flex;
    width: 60%;
    justify-content: center;
}
.TeachersContainer {
    height: 500px;
    overflow-y: auto;
}
.Details {
    position: relative;
}
.Main {
    position: absolute;
    top: 50%;
    left: 50%;
    color: #183153;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
}
.fa-xmark {
    border-radius: 50%;
    /* border: 1px solid #029e02; */
    padding: 5px 8px;
    position: absolute;
    background-color: #f8f9fa;
    top: 0%;
    right: 16%;
    color: #183153;
    transition: 0.2s;
}
.fa-xmark:hover {
    background-color: #029e02;
    color: white;
    cursor: pointer;
}
.overlay {
    position: fixed;
    /* display: none; */
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2;
    transition: 0.7s;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.TeacherAvatar {
    width: 55px;
    height: 55px;
    float: left;
    margin-right: 12px;
    border-radius: 50%;
}
ul li {
    list-style: none;
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
