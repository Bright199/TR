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
                <div class="col-md-7">
                    <ul class="d-flex CrumbContainer">
                        <li class="activeCrumb text-center">1. Select time</li>
                        <li class="text-center">
                            <i class="fa-solid fa-angle-right"></i>
                        </li>
                        <li class="text-center">2. Make a payment</li>
                        <li class="text-center">
                            <i class="fa-solid fa-angle-right"></i>
                        </li>
                        <li class="text-center">3. Prepare your lesson</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-jumbotron body">
            <div class="container">
                <div class="spinner" v-if="loading == true">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>

                <div
                    class="container pt-2 teacherDetails"
                    v-if="loaded === true"
                ></div>
                <BookedProcess v-if="showCalendar2 == true" :teacherDetails = teacherDetails />

                <div class="row" v-if="showCalendar == true">
                    <div class="col-md-2 m-0 p-o">
                        <img src="/images/calendar.png" alt="" width="150" class="CalendarImag">
                    </div>
                    <div class="col-md-4 mb-3">
                        <div
                            class="container calendarContainer shadow bg-white"
                        >
                            <p
                                class="d-flex justify-content-center py-2 border-bottom"
                                style="font-size: 20px"
                            >
                                {{ currentMonth + " " + fullYear }}
                            </p>
                            <section>
                                <div class="days d-flex">
                                    <p
                                        :class="
                                            monthNumber ===
                                                new Date().getMonth() &&
                                            fullYear ===
                                                new Date().getFullYear()
                                                ? 'removeBottomMargin'
                                                : ''
                                        "
                                        class="text-center"
                                        v-for="(day, index) in days"
                                        :key="index"
                                    >
                                        {{ day }}
                                    </p>
                                </div>
                            </section>
                            <section>
                                <div class="dates d-flex">
                                    <p
                                        class="text-center"
                                        v-for="day in firstDay"
                                        :key="day"
                                    >
                                        {{}}
                                    </p>
                                    <p
                                        class="text-center"
                                        v-for="date in lastDateOfMonth"
                                        :key="date"
                                        :class="
                                            date === activateDateClass
                                                ? 'currentDate'
                                                : ''
                                        "
                                    >
                                        <span
                                            v-if="
                                                monthNumber ===
                                                    new Date().getMonth() &&
                                                date < monthDate
                                            "
                                            class="text-light"
                                            >{{}}</span
                                        >
                                        <span
                                            v-else
                                            @click="chooseDate(date)"
                                            >{{ date }}</span
                                        >
                                    </p>
                                    <!-- :class="
                                            new Date(
                                                fullYear,
                                                monthNumber,
                                                date
                                            ).toDateString() ===
                                            new Date().toDateString()
                                                ? 'currentDate'
                                                : ''
                                        " -->
                                </div>
                            </section>
                            <div class="Btns">
                                <button
                                    class="prevMonth"
                                    @click="prevMonthName"
                                    :class="
                                        disablePrevBtn == true
                                            ? 'disablePrevBtn'
                                            : ''
                                    "
                                >
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <button
                                    class="nextMonth"
                                    @click="nextMonthName"
                                >
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 RightBar shadow p-2 bg-white">
                        <div class="row border-bottom RightBarTop">
                            <div class="col-md-4 ps-3">
                                <img
                                    v-if="teacherDetails.teacher_image === null"
                                    src="/images/avatar.png"
                                    width="50"
                                    alt=""
                                />
                                <img
                                    v-else
                                    :src="
                                        '/images/' +
                                        teacherDetails.teacher_image
                                    "
                                    alt=""
                                    width="50"
                                />&nbsp;
                                <router-link
                                    :to="
                                        '/student/single/teacher/' +
                                        teacherDetails.id
                                    "
                                    style="text-decoration:none"
                                    ><span>{{
                                        teacherDetails.name
                                    }}</span></router-link
                                >
                            </div>
                            <div class="col-md-7 BookL">
                                <p
                                    class="d-flex justify-content-center align-item-end shadow-sm"
                                >
                                    Book 1 hour trial lesson
                                </p>
                            </div>
                        </div>
                        <ul class="timeSlots d-flex">
                            <li
                                :class="
                                    activeTime === index ? 'activeSlot' : ''
                                "
                                class="text-center"
                                v-for="(timeslot, index) in timeSlots(
                                    startTime,
                                    endTime
                                )"
                                :key="index"
                                @click="chooseTime(timeslot, index)"
                            >
                                <span> {{ timeslot }}</span>
                            </li>
                        </ul>
                        <div class="container-jumbotron border-top p-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <p>
                                        The calendar is in your time zone
                                        {{ timeZone + " " + timeNow }}
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <button
                                        type="button"
                                        @click="bookTrialLesson"
                                        :class="
                                            pickedTime === '' ||
                                            pickedDate === ''
                                                ? 'disableBtn'
                                                : 'timeConfirmationBtn'
                                        "
                                        ref="timeConfirmationBtn"
                                    >
                                        Confirm time
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import moment from "moment";
import moment from "moment-timezone";
import BookedProcess from "./BookedProcess.vue"
import axios from "axios";
export default {
    name: "TrialLessonBooking",
    components: {BookedProcess},
    props: ["id"],
    data() {
        return {
            months: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            days: ["Sun", "Mon", "Tues", "Wed", "Thu", "Fri", "Sat"],
            monthNumber: new Date().getMonth(),
            monthDate: new Date().getDate(),
            monthDay: new Date().getDay(),
            fullYear: new Date().getFullYear(),
            disablePrevBtn: false,
            startTime: "00:00",
            endTime: "23:30",
            activeTime: "",
            pickedTime: "",
            pickedDate: "",
            activateDateClass: "",
            teacherDetails: "",
            loaded: false,
            loading: false,
            demoLessonsWithThisTeacher: 0,
            showCalendar: false,
            showCalendar2: false,
        };
    },

    methods: {
        bookTrialLesson() {
            if (this.pickedTime === "" || this.pickedDate === "") {
                // this.$refs.timeConfirmationBtn.disabled = true;
                alert("Make sure you pick a day and time");
                return;
            }
            const data = {
                date: this.pickedDate,
                timeslot: this.pickedTime,
                teacherId: this.id,
                timezone: moment.tz.guess(),
            };
            // console.log(moment(this.pickedDate).format('MMMM Do YYYY, h:mm:ss a'))
            axios
                .post("/student/trial/lesson/confirmation", data)
                .then((res) => {
                    window.location.replace(
                        "/student/book/demo/payment/" + this.id
                    );
                });
        },

        nextMonthName() {
            this.disablePrevBtn = false;
            this.pickedDate = "";
            this.pickedTime = "";
            this.activateDateClass = "";
            this.activeTime = "";
            if (this.pickedTime !== "" || this.pickedDate === "") {
                this.$refs.timeConfirmationBtn.disabled = true;
            }
            if (this.monthNumber === 11) {
                this.monthNumber = 0;
                this.fullYear++;
            } else {
                this.monthNumber++;
            }
        },
        prevMonthName() {
            this.pickedDate = "";
            this.pickedTime = "";
            this.activateDateClass = "";
            this.activeTime = "";
            if (this.pickedTime !== "" || this.pickedDate === "") {
                this.$refs.timeConfirmationBtn.disabled = true;
            }
            if (
                this.monthNumber === new Date().getMonth() + 1 &&
                this.fullYear === new Date().getFullYear()
            ) {
                this.disablePrevBtn = true;
            } else {
                this.disablePrevBtn = false;
            }
            // console.log(this.monthNumber)
            // console.log(new Date().getMonth())
            if (this.monthNumber === 0) {
                this.monthNumber = 11;
                this.fullYear--;
            } else {
                this.monthNumber--;
            }
        },
        chooseDate(date) {
            // console.log(new Date(this.fullYear, this.monthNumber, date));
            this.pickedDate = new Date(this.fullYear, this.monthNumber, date+1);
            this.activateDateClass = date;
            if (this.pickedTime !== "") {
                this.$refs.timeConfirmationBtn.disabled = false;
            }
        },
        chooseTime(timeslot, index) {
            this.activeTime = index;
            this.pickedTime = timeslot;
            if (this.pickedDate !== "") {
                this.$refs.timeConfirmationBtn.disabled = false;
            }
        },

        timeSlots(startTime, endTime) {
            let fromTime = moment(startTime, "HH:mm");
            let toTime = moment(endTime, "HH:mm");
            if (toTime.isBefore(fromTime)) {
                toTime.add(1, "day");
            }

            const ar = [];
            while (fromTime <= toTime) {
                ar.push(new moment(fromTime).format("HH:mm"));
                fromTime.add(30, "minutes");
            }
            return ar;
        },
        getTeacherDetails() {
            this.loading = true;
            axios
                .get(`/student/teacher/details/${this.id}`)
                .then((response) => {
                    this.teacherDetails = response.data;
                    this.loaded = true;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getStudentTeacherBookedLesson() {
            axios
                .get("/student/teacher/demo/lessons/" + this.id)
                .then((response) => {
                    if (!Object.keys(response.data).length) {
                        this.showCalendar = true;
                    }else{
                        this.showCalendar2 = true;
                    }

                  
                });
        },
        
    },
    computed: {
        timeNow() {
            return moment().format("HH:mm");
        },
        timeZone() {
            return moment.tz.guess();
        },
        monthName() {
            return this.months[this.monthNumber];
        },
        currentMonth() {
            return new Date(
                this.fullYear,
                this.monthNumber,
                this.monthDate
            ).toLocaleString("default", { month: "long" });
        },
        lastDateOfMonth() {
            return new Date(this.fullYear, this.monthNumber + 1, 0).getDate();
        },
        firstDay() {
            return new Date(this.fullYear, this.monthNumber, 1).getDay();
        },
    },

    mounted() {
        if (
            this.monthNumber === new Date().getMonth() &&
            this.fullYear === new Date().getFullYear()
        ) {
            this.disablePrevBtn = true;
        }
        
        this.getTeacherDetails();
        this.getStudentTeacherBookedLesson();
    },
};
</script>
<style scoped>



.body {
    background-color: rgba(236, 238, 236);
    padding: 25px;
    max-height: 800px;
  min-height: 600px;
}
.activeCrumb {
    font-weight: 550;
    list-style: none;
    margin-right: 10px;
}
.CrumbContainer li:not(.activeCrumb) {
    list-style: none;
    margin-right: 10px;
    color: #79787c;
}
.CrumbContainer {
    flex-wrap: wrap;
}
.fa-angle-left {
    color: #fec107;
}
.DashboardClass {
    font-size: 18px;
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
.RightBarTop img {
    border-radius: 50%;
    height: 50px;
}
.disablePrevBtn {
    display: none;
}
.Btns .nextMonth {
    position: absolute;
    right: 0;
    top: 0;
}
.Btns .prevMonth {
    position: absolute;
    left: 20%;
    top: 5px;
    border: none;
    width: 5%;
    padding: 5px;
    background-color: #ffffff;
}
/* .Btns .prevMonth:hover {
    background-color: #ffffff;
} */
.Btns .nextMonth {
    position: absolute;
    right: 20%;
    top: 5px;
    width: 5%;
    border: none;
    padding: 5px;
    background-color: #ffffff;
}
/* .Btns .nextMonth:hover {
    background-color: #ffffff;
} */
.calendarContainer {
    position: relative;
}
.days p,
.dates p {
    width: 14.28%;
}
.dates {
    flex-wrap: wrap;
}
.dates p span:hover {
    cursor: pointer;
    border:1px solid #029e02;
    border-radius: 2px;
    padding: 5px;
    font-weight: 550;
}
.currentDate span {
    background-color: #029e02;
    padding: 5px;
    color: white;
    font-weight: 550;
}

.removeBottomMargin:first-child {
    border-bottom: 1px solid #e4e6e4;
}
.days p {
    /* font-size: 20px; */
    margin-right: 4px;
    border-bottom: 1px solid #029e02;
}
.RightBar {
    /* height: 550px; */
    overflow-y: auto;
    position: relative;
}


.BookL p {
    border-top-left-radius: 50px;
    border-bottom-left-radius: 50px;
    background-color: white;
    padding: 8px;
}

.timeSlots {
    flex-wrap: wrap;
    flex-direction: row;
    margin-top: 10px;
    overflow: auto;
}
.timeSlots li {
    width: 16.66%;
    /* padding: 5px; */
    list-style: none;
    color: #029e02;
}
.timeSlots li:hover {
    cursor: pointer;
    /* font-weight: 550; */
    border: 1px solid #029e02;
    border-radius: 2px;
}
.activeSlot {
    background-color: #029e02;
    color: white;
}
.activeSlot span {
    background-color: #029e02;
    color: white;
}
.timeConfirmationBtn {
    border: none;
    padding: 5px;
    background-color: #fec107;
    color: #151419;
    border-radius: 20px;
    width: 60%;
}
.timeConfirmationBtn:hover {
    background-color: #fcc41d;
}
.disableBtn {
    background-color: #e7ece7;
    color: #797c79;
    border: none;
    padding: 5px;
    border-radius: 20px;
    width: 60%;
}
</style>
