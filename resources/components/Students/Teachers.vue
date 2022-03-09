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
                        <a
                            :href="'single/teacher/' + teacher.id"
                            class="teacherDetailsLink"
                        >
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
                                    <p>{{ teacher.description }}</p>
                                </div>
                                <div class="col-md-2">
                                    <a href="/student/dashboard"
                                        >Hire {{ teacher.name }}</a
                                    >
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div v-else>
                    <div class="spinner" v-if="loading2 == true">
                        <div class="dot1"></div>
                        <div class="dot2"></div>
                    </div>
                    <h2 v-if="loaded == true">Check again some other time for available teachers</h2>
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
            loading2: false,
            loaded:false
        };
    },
    mounted() {
        this.loading2 = true;
        const thisValue = this;
        axios
            .get("/student/our/teachers")
            .then(function (response) {
                thisValue.teachers = response.data;
                if(thisValue.teachers == null){
                    thisValue.loaded = true
                }
            })
            .finally(function () {
                this.loading2 = false;
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
.teacherDetailsLink {
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
</style>
