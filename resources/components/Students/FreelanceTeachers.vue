<template>
    <div>
        <DashboardNavBar />
        <div class="container">
            <div class="row">
                <div class="col-md-3 me-3 mt-4 shadow-sm LeftBar">
                    <router-link to="/student/teachers"
                        >Our teachers</router-link
                    >
                    <router-link
                        to="/student/freelance/teachers"
                        style="background-color: #029e02; color: white"
                        >Freelance teachers</router-link
                    >
                </div>
                <div class="col-md-8 mb-4 mt-4 shadow-sm">
                    <OtherTeacherDetails/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import DashboardNavBar from "./DashboardNavBar.vue";
import OtherTeacherDetails from './OtherTeacherDetail/OtherTeacherDetails.vue';
export default {
    name: "Teachers",
    components: {
        DashboardNavBar,
        OtherTeacherDetails
    },
    data() {
        return {
            teachers: {},
            loading2: false,
            loaded: false,
        };
    },
    mounted() {
    },
    methods: {
    },
};
</script>
<style scoped>
.LeftBar {
    height: 250px;
}
.LeftBar :first-child{
    margin-top: 15px
}
.LeftBar a {
    /* background-color: #029e02; */
    padding: 5px;
    color: #151419;
    display: block;
    text-align: center;
    width: 80%;
    margin: auto;
    margin-bottom: 10px;
    text-decoration: none;
    /* color: white; */
    font-size: 20px;
    border: 1px solid #029e02;
}
.LeftBar a:hover {
    background-color: #029e02;
    color: white;
}

.TeachersContainer {
    height: 700px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
