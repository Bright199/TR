<template>
    <div>
        <DashboardNavBar />
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <img
                                src="/images/Green2.png"
                                alt=""
                                width="200"
                            />
                        </div>
                        <div class="col-md-8 border shadow-sm">
                            <h3>
                                {{ teacherDetails.name }} &nbsp;<i
                                    class="fa-solid fa-shield-blank"
                                    style="color: #029e02; font-size: 18px"
                                ></i>
                            </h3>
                            <p>{{teacherDetails.description }}</p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div
                                        class="col-md-9 d-flex justify-content-end"
                                    >
                                        <p>
                                            Speaks {{ teacherDetails.first_language }}
                                            <span
                                                class="MainFluencyLevel"
                                                style="font-weight: 500"
                                                >{{
                                                    teacherDetails.first_language_proficiency
                                                }}</span
                                            >
                                            {{ teacherDetails.second_language }}
                                            <span
                                                class="FluencyLevel"
                                                style="font-weight: 500"
                                                >{{
                                                    teacherDetails.second_language_proficiency
                                                }}</span
                                            >
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- @if ($isOurTeacher === 1) -->
                            <p>
                                Works for
                                <span style="font-weight: 500; color: #029e02"
                                    >TREnglish
                                </span>
                            </p>
                            <!-- @endif -->
                            <p style="font-weight: 700; font-size: 16px">
                                <i class="fa-solid fa-dollar-sign"></i
                                >{{ teacherDetails.hourly_pay }} USD /hour
                            </p>
                            <p>
                                Joined on
                                {{ teacherDetails.created_at }}
                            </p>
                            <p>{{ teacherDetails.nationality }}</p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <!-- Button to Open the Modal -->
                    <a
                        href="#"
                        class="hireBtn"
                        data-bs-toggle="modal"
                        data-bs-target="#MessageModal"
                    >
                        Hire 
                        {{ teacherDetails.name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { mapState, mapMutations } from "vuex";
import moment from "moment";
import DashboardNavBar from "./DashboardNavBar.vue";
export default {
    name: "SingleTeacher",
    props: ["id"],
    components: {
        DashboardNavBar,
    },
    data() {
        return {
            teacherDetails:''
        }
    },
    methods: {
        getTeacherDetails() {
            axios
                .get(`/student/teacher/details/${this.id}`)
                .then((response) => {
                    this.teacherDetails = response.data;
                    
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },
    },
    mounted() {
        this.getTeacherDetails()
    }
};
</script>
