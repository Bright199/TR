<template>
    <div>
        <DashboardNavBar />
        <div class="container-jumbotron " >
            <div class="container mt-2 p-4">
                <div class="row">
                    <div
                        class="col-md-2 mb-2 me-2 shadow-sm bg-white p-2 LinksContainer"
                    >
                        <ul class="Links">
                            <li
                                class="text-center"
                                @click="LessonsActivate"
                                :class="LessonsActive ? 'demoActive' : ''"
                            >
                                My Lessons
                            </li>
                            <li
                                class="text-center"
                                :class="demoActive ? 'demoActive' : ''"
                                @click="demoActivate"
                            >
                                Trial Lessons
                            </li>
                        </ul>
                    </div>
                    <DemoLists v-if="demoActive" />
                    <LessonsLists v-if="LessonsActive" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DashboardNavBar from "../DashboardNavBar.vue";
import DemoLists from "./DemoLists.vue";
import LessonsLists from "./LessonsLists.vue";
export default {
    name: "AllBookedLessons",
    components: { DashboardNavBar, DemoLists, LessonsLists },
    data() {
        return {
            allLessons: "",
            demoActive: false,
            LessonsActive: true,
        };
    },
    mounted() {
        this.getAllBookedLessons();
    },
    methods: {
        demoActivate() {
            this.demoActive = true;
            this.LessonsActive = false;
        },
        LessonsActivate() {
            this.LessonsActive = true;
            this.demoActive = false;
        },
        getAllBookedLessons() {},
    },
};
</script>

<style>
.Links li {
    list-style: none;
    margin-bottom: 8px;
    border: 1px solid #029e02;
    border-radius: 3px;
    padding: 0px 0px 3px;
}
.Links li:hover {
    background-color: #029e02;
    cursor: pointer;
    color: white;
}
.Links {
    padding: 0;
}
.LinksContainer {
    height: 150px;
}
.demoActive {
    background-color: #029e02;
    color: white;
}
.demoActive {
    background-color: #02ad02;
}
</style>
