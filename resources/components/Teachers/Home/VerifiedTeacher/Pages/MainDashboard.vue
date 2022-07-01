<template>
    <div>
        <div class="row">
            <div class="col-md-3 p-4 bg-white rounded">
                <img :src="'/storage/teacher/images/' + teacherDetails.teacher_image" alt="teacher_image"
                    class="rounded-circle d-block mx-auto" style="height: 85px; width: 85px" />
                <p class="text-center">
                    {{ teacherDetails.name }}
                </p>
                <div v-if="teacherDetails.account_vissible === 0">
                    <p class="text-center">Account Status: <span style="color:#029e20;">Visible <i
                                class="fa-solid fa-eye" style="color:#029e20"></i></span></p>
                    <button class="btn btn-outline-primary d-block mx-auto" @click="hideProfile">Hide Profile</button>
                </div>
                <div v-else>
                    <p class="text-center text-danger">Account Status: Hidden <i
                                class="fa-solid fa-eye-slash"></i></p>
                    <button class="btn btn-secondary d-block mx-auto" @click="showProfile">Show Profile</button>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['teacherDetails'],
    name: 'MainDashboard',
    data() {
        return {
            // TeacherDetails: ''
        }
    },
    methods: {
        hideProfile() {
            axios.post('/teacher/hideProfile')
                .then(() => {
                    alert('Account is now hidden from people. Refresh the page.')
                })
        },
        showProfile() {
            axios.post('/teacher/showProfile')
                .then(() => {
                    alert('Account is now vissible from people. Refresh the page.')
                })
        }
    },
    mounted() {
    },
}
</script>

<style lang="scss" scoped>
</style>