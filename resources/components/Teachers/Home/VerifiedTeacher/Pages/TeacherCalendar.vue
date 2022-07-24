<template>
    <div class="p-2">
        <NavBar :calendarComponent='calendarComponent' />
        <div class="">
            <ul class="d-flex gap-5 p-5">
                <li>
                    <button @click="prevWeekFirstDate">Prev</button>
                </li>
                <li>
                    <button @click="nextWeekFirstDate">Next</button>
                </li>
                <li>
                    {{ dates[firstDyOfweek().getMonth()] + ' ' + firstDyOfweek().getDate() }} - {{
                            dates[lastDyOfweek().getMonth()] + ' ' + lastDyOfweek().getDate()
                    }} , {{ lastDyOfweek().getFullYear() }}
                </li>

            </ul>

            <!-- <li v-for="slot in timeZone()" :key="slot">
            {{ slot }}
            </li> -->
            <ul class="d-flex gap-5 bg-light w-100">
                <li v-for="(day, index) in days" :key="day">
                    <span class="fw-bolder ">{{ day + ' ' + dateChange(index).getDate() }}</span>

                    <ul class="d-flex flex-column p-0 m-0 timeSlots">
                        <li v-for="time_slot in timeZone()" :key="time_slot" :id="dateClass(index, time_slot)"
                            @click="addDateClassStyle(index, time_slot)">{{ time_slot
                            }}
                        </li>
                    </ul>
                </li>
            </ul>

            {{ firstDyOfweek() }}

        </div>
    </div>
</template>

<script>
import moment from 'moment-timezone'
var curr = new Date; // get current date
var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
var last = first + 6; // last day is the first day + 6

var firstday = new Date(curr.setDate(first)).toUTCString();
var lastday = new Date(curr.setDate(last)).toUTCString();
console.log(firstday);
console.log(lastday);
import NavBar from '../NavBar.vue';
export default {
    name: "TeacherCalendar",
    components: { NavBar },
    data() {
        return {
            calendarComponent: false,
            todayDate: new Date(),
            days: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            startTime: '00:00',
            endTime: '23:00',
            dates: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ],
        }
    },
    mounted() {
        this.calendarComponent = true
    },
    methods: {
        dateClass(i, ts) {
            return '' + this.dateChange(i).getDate() + '' + this.dateChange(i).getMonth() + '' + this.dateChange(i).getFullYear() + '' + ts
        },
        timeZone() {
            const srtT = moment(this.startTime, 'HH:mm')
            const endT = moment(this.endTime, 'HH:mm')

            if (endT.isBefore(srtT)) {
                endT.add(1, 'day')
            }

            const TimeSlots = []
            while (srtT <= endT) {
                TimeSlots.push(new moment(srtT).format('HH:mm'))
                srtT.add(1, 'hour')
            }
            return TimeSlots;
        },
        dateChange(index) {
            return new Date(this.todayDate.setDate(this.firstDyOfweek().getDate() + index))
        },
        firstDyOfweek() {
            return new Date(this.todayDate.setDate(this.todayDate.getDate() - this.todayDate.getDay()))
        },
        lastDyOfweek() {
            return new Date(this.todayDate.setDate(this.todayDate.getDate() - this.todayDate.getDay() + 6))
        },
        nextWeekFirstDate() {
            const fstD = this.todayDate.getDate() - this.todayDate.getDay()
            this.todayDate = new Date(this.todayDate.setDate(fstD + 7))
            this.firstDyOfweek()
        },
        prevWeekFirstDate() {
            const fstD = this.todayDate.getDate() - this.todayDate.getDay()
            this.todayDate = new Date(this.todayDate.setDate(fstD - 7))
            this.firstDyOfweek()
        },
        addDateClassStyle(i, ts) {
            const className = document.getElementById('' + this.dateChange(i).getDate() + '' + this.dateChange(i).getMonth() + '' + this.dateChange(i).getFullYear() + '' + ts);
            className.classList.toggle('activeSlot')
        }
    },
}
</script>

<style lang="scss" scoped>
li {
    list-style: none;
    padding: 10px;
}

.timeSlots li:hover {
    cursor: pointer;
    opacity: 1;
    color: white;
    background-color: #029e20;

}

.timeSlots li {
    /* opacity: 0; */

}
</style>
