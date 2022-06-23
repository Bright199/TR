<template>
    <div>
        <div class="spinner" v-if="loading">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
        <div class="container-jumbotron bg-white rounded-2" v-if="loaded">
            <div class="container-jumbotron d-flex justify-content-center border-bottom">
                <ul class="breadCrumbs">
                    <li class="prevCrumb">About
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                    </li>
                    <li class="prevCrumb">
                        Description
                    </li>
                    <li class="prevCrumb">
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                        Qualification
                    </li>
                    <li class="prevCrumb">
                        <!-- <i class="fa-solid fa-chevron-right"></i> &nbsp; -->
                        Video
                    </li>
                    <li class="activeCrumb">
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                        Availability
                    </li>
                </ul>
            </div>

            <div class="bg-white w-100 h-100">
                <div class="container p-5">
                    <div class="row">
                        <div class="col-md-4">
                            <h5><span class="text-danger">**</span> Your timezone is: <span style="color: #F56F26">{{
                                    userTimeZone
                            }}</span></h5>
                            <p>If this is not your timezone please change in the timezone list below. This will be used
                                by the
                                system to
                                schedule the lessons with your students who are living in a different timezone.</p>
                            <select class="form-select" @change="selectedTimeZone" v-model="userTimeZone">
                                <option selected>{{ userTimeZone }}</option>
                                <option v-for="(timezone, index) in getTimeZone()" :key="index" :value="timezone">{{
                                        timezone + " " + timezoneDisplay(new Date(),
                                            timezone).format("Z")
                                }}</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-center p-3">Choose your availability time.</h3>
                            <div class="row border p-4">
                                <div class="col-md-4 days-container">
                                    <ul>
                                        <li v-for="(day, index) in days" :key="index" @click="selectWeekDay(index)"
                                            class="weekDay" :class="index === selectedDayIndex ? 'activeDay' : ''">{{
                                                    day
                                            }}
                                        </li>
                                    </ul>
                                </div>
                                <!-- Days slots -->
                                <Monday v-if="selectedDayIndex === 0" />
                                <Tuesday v-if="selectedDayIndex === 1" />
                                <Wednesday v-if="selectedDayIndex === 2" />
                                <Thursday v-if="selectedDayIndex === 3" />
                                <Friday v-if="selectedDayIndex === 4" />
                                <Saturday v-if="selectedDayIndex === 5" />
                                <Sunday v-if="selectedDayIndex === 6" />
                                <RecordSavedMessage v-if="selectedDayIndex === 7" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-jumbotron p-4 border-top">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="d-grid gap-2">
                            <button class="EditBtn" @click="backToVideo"><i class="fa-solid fa-angle-left"></i>
                                Back</button>
                            <button class="NextBtn" @click="finishRegistration">Submit Application <i
                                    class="fa-solid fa-angle-right"></i></button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

import axios from "axios";
import moment from 'moment-timezone'
import Monday from './DaysComponent/Monday.vue'
import { mapState } from 'vuex'
import Tuesday from './DaysComponent/Tuesday.vue'
import Wednesday from './DaysComponent/Wednesday.vue'
import Thursday from './DaysComponent/Thursday.vue'
import Friday from './DaysComponent/Friday.vue'
import Saturday from './DaysComponent/Saturday.vue'
import Sunday from './DaysComponent/Sunday.vue'
import RecordSavedMessage from "./DaysComponent/RecordSavedMessage.vue";
export default {
    name: "Availability",
    components: {
        Monday,
        Tuesday,
        Wednesday,
        Thursday,
        Friday,
        Saturday,
        Sunday,
        RecordSavedMessage
    },
    data() {
        return {
            loading: false,
            loaded: false,
            teacherDetails: '',
            timezoneDetails: '',
            userTimeZone: '',
            days: [
                'MONDAY',
                'TUESDAY',
                'WEDNESDAY',
                'THURSDAY',
                'FRIDAY',
                'SATURDAY',
                'SUNDAY'
            ]

        };
    },
    mounted() {
        this.getTeacherDetails()
        this.getTimeZone()
        this.defaultTimeZone()
    },
    methods: {
        selectedTimeZone() {
            this.$store.commit({
                type: 'setUserTimezone',
                timezone: this.userTimeZone
            })
        },
        selectWeekDay(i) {
            this.$store.commit({
                type: 'setDayIndex',
                dayIndex: i
            })
        },
        getTimeZone() {
            return moment.tz.names();
        },
        timezoneDisplay(d, tZone) {
            return moment.tz(d, tZone);
            //   return  moment.tz(d,tZone).format("DD-MM-YYYY h:mm:ss a");
            //   return  moment.tz(d,tZone).format("DD-MM-YYYY h:mm:ss a");
        },
        defaultTimeZone() {
            this.userTimeZone = moment.tz.guess()
            this.$store.commit({
                type: 'setUserTimezone',
                timezone: this.userTimeZone
            })
        },
        backToVideo() {
            this.$store.commit({
                type: "setVideoComponent"
            })
        },
        finishRegistration() {
            this.loading = true
            axios.post('/teacher/submitRegistrationForm')
            .then(()=>{
                this.$router.push('/teacher/dashboard')
            })

            .finally(()=>{
                this.loading = false
            })
        },
        getTeacherDetails() {
            this.loading = true
            axios.get('/teacher/getTeacherDetails')
                .then((response) => {
                    this.teacherDetails = response.data;
                    this.loaded = true
                }).finally(() => {
                    this.loading = false;
                })
        },
    },
    computed: {
        ...mapState({
            selectedDayIndex: state => state.selectedDayIndex
        })
    },
};
</script>

<style scoped>
.activeDay {
    background-color: #029e02;
    padding: 10px;
    text-align: center;
    color: white !important;
}

.weekDay {
    border: 1px solid #029e02;
    border-radius: 5px;
    color: #029e02;
    padding: 10px;
    margin-bottom: 15px;
    list-style: none;
    text-align: center;
}

.weekDay:hover {
    background-color: #029e20;
    cursor: pointer;
    color: white;
}

.toolTip {
    font-size: 14px;
}

.toolTip:hover {
    cursor: pointer;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.form-select:focus {
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}

/* button */

.editName:hover {
    background: #03b403;
}

.prevCrumb {
    opacity: 0.3;
}

.NextBtn {
    padding: 7px 15px 9px;
    border: 1px solid #029e02;
    background: white;
    border-radius: 5px;
    transition: 0.3s;
    color: #029e02;
}

.NextBtn:hover {
    background: #029e02;
    color: white;
    font-size: 18px;
}

.NextBtn:hover i {
    font-size: 15px;
    color: white;
}

.EditBtn {
    padding: 7px 15px 9px;
    background: #029e02;
    transition: 0.3s;
    border: none;
    border-radius: 5px;
    color: white;
}


.EditBtn:hover i {
    color: white;
    font-size: 15px
}

.EditBtn:hover {
    background: #02aa02;
    font-size: 18px;
}

/*  */


.activeCrumb {
    color: #029e02;
    font-weight: 550;
}

.nextCrumb {
    font-weight: 550;
}

.fa-chevron-right {
    font-size: 12px;
}

.activeCrumb:hover {
    cursor: pointer;
}

.breadCrumbs {
    display: flex;
    flex-wrap: wrap;
    padding: 0;
    align-content: center;
}

.breadCrumbs li {
    list-style: none;
    padding: 13px 12px 2px;
}

@media only screen and (max-width: 768px) {
    .breadCrumbs {
        display: flex;
        flex-direction: column;
        padding: 0;
        align-content: center;
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
