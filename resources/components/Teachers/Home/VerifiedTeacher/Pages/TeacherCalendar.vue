<template>
    <div class="p-2">
        <NavBar :calendarComponent='calendarComponent'/>
    </div>
</template>

<script>
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
            calendarComponent: false
        }
    },
    mounted () {
       this.calendarComponent = true
    },
}
</script>

<style lang="scss" scoped>

</style>