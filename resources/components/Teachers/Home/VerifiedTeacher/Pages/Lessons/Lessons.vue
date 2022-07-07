<template>
    <div>
        <div class="lessons-header mb-3 pb-2 border-bottom">
            <h5>Active lessons</h5>
        </div>
        <div class="active-lessons p-2">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Students</td>
                        <td>Lesson status</td>
                        <td>Price per lesson</td>
                        <td>Lesson Plan</td>
                        <td>Actions</td>
                    </tr>
                    <tr v-for="lesson in 5" :key="lesson">
                        <td>
                            <img src="/images/avatar.png" alt="student_avatar" style="height: 65px; width: 65px;"
                                class="rounded-circle">
                            <p>Bright</p>
                        </td>
                        <td>Waiting for confirmation</td>
                        <td>$4/hour</td>
                        <td>Lesson Plan</td>
                        <td @click="alertSomething"><i class="fa-solid fa-ellipsis"></i></td>
                    </tr>
                </tbody>
            </table>
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
        alertSomething(e) {
            console.log(e)
},
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