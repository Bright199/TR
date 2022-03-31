<template>
        <div class="col-md-9 mb-2 me-2 shadow-sm bg-white p-2">
            <div class="container-jumbotron border-bottom">
                <p>Lessons details</p>
            </div>
            <div class="container">
                <table
                    class="table table-responsive table-striped table-sm table-hover"
                >
                    <tr v-for="lesson in demoLessons" :key="lesson">
                        <td>Date: {{ dateTime(lesson.date) }}</td>
                        <td>Time: {{ lesson.timeslot }}</td>
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
                            <router-link to="/student/view/demo/lesson"
                                >View</router-link
                            >
                        </td>
                    </tr>
                </table>
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

</style>
