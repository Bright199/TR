<template>
    <div>
        <DashboardNavBar />
        <div class="row">
            <div class="col-md-3 LeftBar">
                <a href="" class="">Our teachers</a><br />
                <a href="" class="">Freelance teachers</a>
            </div>
            <div class="col-md-8">
                <h4 style="text-align: center; margin-top: 8px">
                    Our Teachers
                </h4>
                <div v-if="teachers.length > 0">
                    <div v-for="(teacher, index) in teachers" :key="index">
                        <a :href="'single/teacher/' + teacher.id"  class="teacherDetailsLink">
                            <div class="row teacherDetails">
                                <div class="col-md-4">
                                    <img
                                        src="/images/Green2.png"
                                        alt=""
                                        width="150"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <h3>
                                        {{ teacher.name }}
                                    </h3>
                                    <p>Description</p>
                                </div>
                                <div class="col-md-2">
                                    <a href="/student/dashboard">Hire</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div v-else>
                    <h2>Check again some other time for available teachers</h2>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import DashboardNavBar from "./DashboardNavBar.vue";
export default {
    name: "Teachers",
    components: { DashboardNavBar },
    data() {
        return {
            teachers: "",
        };
    },
    mounted() {
        const thisValue = this;
        axios.get("/student/our/teachers").then(function (response) {
            thisValue.teachers = response.data;
        });
    },
};
</script>
<style scoped>
.LeftBar {
    height: 250px;
    padding: 10px;
    /* margin: 50%; */
    border-right: 2px solid rgb(207, 205, 205);
}
.LeftBar a {
    background-color: #fec107;
    padding: 10px;
    color: #151419;
    display: block;
    /* margin-top: auto; */
    text-align: center;
}
.teacherDetails {
    border: 1px solid rgb(207, 205, 205);
    margin-left: 3px;
}
.teacherDetails:hover {
    background-color: rgba(185, 185, 185, 0.1);
}
.teacherDetailsLink{ 
    color: #151419;
    text-decoration: none;
}
</style>
