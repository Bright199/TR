<template>
    <div>
        <DashboardNavBar />
        <div class="container-jumbotron bg-light" style="height: 100vh">
            <div class="container mt-2 p-4">
                <div class="row">
                    <div class="col-md-2 mb-2 me-2 shadow-sm bg-white p-2">
                        <ul class="Links">
                            <li class="text-center">My Lessons</li>
                            <li class="text-center">Demo Lessons</li>
                        </ul>
                    </div>
                    <DemoLists />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DashboardNavBar from "../DashboardNavBar.vue";
import DemoLists from "./DemoLists.vue";
export default {
    name: "AllBookedLessons",
    components: { DashboardNavBar, DemoLists },
    data() {
        return {
            allLessons: "",
        };
    },
    mounted() {
        this.getAllBookedLessons();
    },
    methods: {
        getAllBookedLessons() {},
    },
};
</script>

<style>
.Links li {
    list-style: none;
    background-color: #029e02;
    color: white;
    margin-bottom: 8px;
    /* padding: 5px 15px 7px; */
}
.Links {
    padding: 0;
}
</style>
