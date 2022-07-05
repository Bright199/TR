<template>
    <div>
        <div class="lessons-header mb-3 pb-2 border-bottom">
            <h5>Active lessons</h5>
        </div>
        <div class="active-lessons p-2">
            <div class="row border-bottom ">
                <div class="col-md-2">
                    <p>Students</p>
                </div>
                <div class="col-md-2">
                    Lesson status
                </div>
                <div class="col-md-2">
                    <p>Price per lesson</p>
                </div>
                <div class="col-md-2">
                    <p>Messages</p>
                </div>
                <div class="col-md-2">
                    <p>Lesson Plan</p>
                </div>
                <div class="col-md-2">
                    <p>Actions</p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
            <div class="row border-bottom ">
                <div class="col-md-2 d-lg-flex g-3 d-lg-flex align-items-lg-center">
                    <img src="/images/avatar.png" alt="student_avatar" style="height: 65px; width: 65px;"
                        class="rounded-circle">
                    <p>Bright</p>
                    <!-- <img :src="'/storage/student/images'" alt="student-image"> -->
                </div>
                <div class="col-md-2 d-lg-flex align-items-lg-center">
                    <p> Waiting for confirmation</p>
                </div>
                <div class="col-md-2 d-lg-flex align-items-lg-center">
                    <p>$4/hour</p>
                </div>
                <div class="col-md-2 d-lg-flex align-items-lg-center">
                    <i class="fa-solid fa-message"></i>
                </div>
                <div class="col-md-2 d-lg-flex align-items-lg-center">
                    <p>Lesson Plan</p>
                </div>
                <div class="col-md-2 d-lg-flex align-items-lg-center">
                    <p><i class="fa-solid fa-ellipsis"></i></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'Lessons',
    data() {
        return {
            allTeacherStudents: ''
        }
    },
    methods: {
        getTeacherStudents() {
            axios.get('/teacher/getTeacherStudents')
                .then((res) => {
                    this.allTeacherStudents = res.data
                })
        }
    },
    mounted() {
        this.getTeacherStudents;
    },
}
</script>

<style lang="scss" scoped>
</style>