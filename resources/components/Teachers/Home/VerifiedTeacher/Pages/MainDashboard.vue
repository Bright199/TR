<template>
    <div>
        <div class="row p-4">
            <div class="col-md-2 p-4 mb-3 bg-white rounded h-100 shadow-sm">
                <img :src="'/storage/teacher/images/' + teacherDetails.teacher_image" alt="teacher_image"
                    class="rounded-circle imgRounded d-block mx-auto" style="height: 95px; width: 85px" />
                <p class="text-center">
                    {{ teacherDetails.name }}
                </p>
                <div v-if="teacherDetails.account_vissible === 0">
                    <p class="text-center">Account Status: <span style="color:#029e20;">Visible <i
                                class="fa-solid fa-eye" style="color:#029e20"></i></span></p>
                    <button class="btn btn-primary d-block mx-auto" @click="hideProfile">Hide Profile</button>
                </div>
                <div v-else>
                    <p class="text-center text-danger">Account Status: Hidden <i
                                class="fa-solid fa-eye-slash"></i></p>
                    <button class="btn btn-secondary d-block mx-auto" @click="showProfile">Show Profile</button>
                </div>

                <div class="container border-top mt-4 p-2">
                    <p class="text-center">
                       Charges: <span style="color:#029e20">${{ teacherDetails.hourly_pay }}/hour</span>
                    </p>
                    <p class="text-center">
                       Teaches: <span style="color:#029e20">{{ teacherDetails.first_language }}</span>
                    </p>
                </div>
            </div>
            <!-- <div class="col-md-1 ">
            </div> -->
            <div class="col-md-9 ms-lg-3 p-4 bg-white rounded h-100">
                <Lessons/>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import Lessons from './Lessons/Lessons.vue';
export default {
    props: ["teacherDetails"],
    name: "MainDashboard",
    data() {
        return {
        // TeacherDetails: ''
        };
    },
    methods: {
        hideProfile() {
            axios.post("/teacher/hideProfile")
                .then(() => {
                alert("Account is now hidden from people. Refresh the page.");
            });
        },
        showProfile() {
            axios.post("/teacher/showProfile")
                .then(() => {
                alert("Account is now vissible from people. Refresh the page.");
            });
        }
    },
    mounted() {
    },
    components: { Lessons }
}
</script>

<style lang="scss" scoped>

</style>