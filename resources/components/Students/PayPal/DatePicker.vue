<template>
    <div>
        <div class="container">
            <h4>Book 1 hour trial lesson</h4>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <div class="container calendarContainer border shadow-sm">
                        <h4 class="d-flex justify-content-center p-3">
                            {{ currentMonth + " " + fullYear }}
                        </h4>
                        <section>
                            <div class="days d-flex">
                                <p
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
                                >
                                    <span
                                        :class="
                                            new Date(
                                                fullYear,
                                                monthNumber,
                                                date
                                            ).toDateString() ===
                                            new Date().toDateString()
                                                ? 'currentDate'
                                                : ''
                                        "
                                        @click="chooseDate(date)"
                                        >{{ date }}</span
                                    >
                                </p>
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
                <div class="col-md-7 RightBar shadow-sm border">

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "DatePicker",
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
        };
    },

    methods: {
        nextMonthName() {
            this.disablePrevBtn = false;
            if (this.monthNumber === 11) {
                this.monthNumber = 0;
                this.fullYear++;
            } else {
                this.monthNumber++;
            }
        },
        prevMonthName() {
            if (
                this.monthNumber === new Date().getMonth()+1 &&
                this.fullYear === new Date().getFullYear()
            ) {
                this.disablePrevBtn = true;
            }else{
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
        },
    },
    computed: {
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
        // + " " + Day + " " + monthDate
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
    },
};
</script>
<style scoped>
/* .Btns{
    top: 0;
    background-color: red
} */
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
    top: 10px;
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
    top: 10px;
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
.currentDate {
    background-color: #029e02;
    padding: 5px;
    color: white;
    font-weight: 550;
}
.days p {
    font-size: 22px;
}
.RightBar{
    height: 550px;
    overflow-y: auto;
}
</style>
