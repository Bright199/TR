<template>
    <div>
        <div class="container">
            <p class="pt-3 px-3" style="font-size: 20px">
                Book 1 hour trial lesson
            </p>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <div
                        class="container calendarContainer border shadow-sm p-0"
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
                                        monthNumber === new Date().getMonth() &&
                                        fullYear === new Date().getFullYear()
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
                                    <span @click="chooseDate(date)">{{
                                        date
                                    }}</span>
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
                            <button class="nextMonth" @click="nextMonthName">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 RightBar shadow-sm border p-0">
                    <ul class="timeSlots d-flex">
                        <li
                            :class="activeTime === index ? 'activeSlot' : ''"
                            class="text-center"
                            v-for="(timeslot, index) in timeSlots(
                                startTime,
                                endTime
                            )"
                            :key="index"
                            @click="chooseTime(timeslot,index)"
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
                                        pickedTime === '' || pickedDate === ''
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
</template>
<script>
// import moment from "moment";
import moment from "moment-timezone";
export default {
    name: "TrialLessonBooking",
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
        };
    },

    methods: {
        bookTrialLesson() {
            console.log(this.pickedTime);
            console.log(this.pickedDate);
        },

        nextMonthName() {
            this.disablePrevBtn = false
            this.pickedDate = ''
            this.pickedTime = ''
            this.activateDateClass = ''
            this.activeTime =''
            if (this.pickedTime !== "" || this.pickedDate === '') {
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
            this.pickedDate = ''
            this.pickedTime = ''
            this.activateDateClass = ''
            this.activeTime =''
            if (this.pickedTime !== "" || this.pickedDate === '') {
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
            this.pickedDate = new Date(this.fullYear, this.monthNumber, date);
            this.activateDateClass = date;
            if (this.pickedTime !== "") {
                this.$refs.timeConfirmationBtn.disabled = false;
            }
        },
        chooseTime(timeslot,index) {
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
        if (this.pickedTime === "" || this.pickedDate === "") {
            this.$refs.timeConfirmationBtn.disabled = true;
        }
    },
};
</script>
<style scoped>
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
    border: 1px solid #fafafa;
    width: 5%;
    padding: 5px;
    background-color: #fafafa;
}
.Btns .prevMonth:hover {
    background-color: #f1f0f0;
}
.Btns .nextMonth {
    position: absolute;
    right: 20%;
    top: 5px;
    border: 1px solid #fafafa;
    width: 5%;
    padding: 5px;
    background-color: #fafafa;
}
.Btns .nextMonth:hover {
    background-color: #f1f0f0;
}
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
    background-color: #029e02;
    padding: 5px;
    color: white;
    font-weight: 550;
}
.currentDate span {
    background-color: #029e02;
    padding: 5px;
    color: white;
    font-weight: 550;
}

.removeBottomMargin:first-child {
    border-bottom: 2px solid #e4e6e4;
}
.days p {
    font-size: 20px;
    margin-right: 4px;
    border-bottom: 2px solid #029e02;
}
.RightBar {
    /* height: 550px; */
    overflow-y: auto;
}

.timeSlots {
    flex-wrap: wrap;
    margin-top: 10px;
}
.timeSlots li {
    width: 16.66%;
    padding: 5px;
    list-style: none;
    color: #029e02;
}
.timeSlots li:hover {
    cursor: pointer;
    font-weight: 550;
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
    background-color: #029e02;
    color: white;
    border-radius: 20px;
    width: 60%;
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
