<template>
  <div class="col-md-3 col-lg-3 col-sm-3 p-0 bg-white border">
                <div class="container p-0 HeadingContainer">
                    <p class="text-white text-center p-3 m-0 Heading">ADVANCED</p>
                </div>
                <div class="container packageDetails p-3 ">
                    <p class="text-center"><span class="numberOfLessons ">20</span><span class="textLessons">Lessons</span></p>
                </div>
                <div class="container p-0">
                    <p class="text-center"><span class="themeColor">Teacher: </span>{{teacherDetails.name}}</p>
                    <p class="text-center" v-if="loaded"><span class="themeColor">Teacher's fee: </span>${{teacherDetails.hourly_pay}}/hour</p>
                    <p class="text-center" v-if="loaded"><span class="totalPrice">${{parseFloat(teacherDetails.hourly_pay) * parseFloat(lessonDetails[2].ADVANCED) - parseFloat(10)}}</span></p>
                    <p class="text-center"><span class="themeColor">You save $10</span></p>
                </div>
                <div class="container p-0 d-flex justify-content-center">
                    <button class="buyBtn d-block text-center " @click="buyHours(teacherDetails.id, parseFloat(teacherDetails.hourly_pay) * parseFloat(lessonDetails[2].ADVANCED) - parseFloat(10))">Buy Hours</button>
                </div>
                <div class="container packageBenefits p-3">
                    <p><i class="fa-solid fa-circle-check"></i> Transfer hours to another teacher if teacher doesn't meet your needs.</p>
                    <p><i class="fa-solid fa-circle-check"></i> Ask for refund for the remaining hours (If applicable)</p>
                </div>
            </div>
</template>

<script>
import axios from 'axios';
export default {
name: 'Advanced',
props: ['userId'],
 data() {
        return {
            User: "",
            loading: false,
            loaded: false,
            teacherDetails: "",
            lessonDetails: [{ STARTER: 5 }, { PRO: 12 }, { ADVANCED: 20 }],
        };
    },
    mounted() {
        this.getUser();
        this.getTeacherDetails();
    },
    methods: {
        getUser() {
            this.loading = true;
            axios
                .get("/student/getAuthUser")
                .then((response) => {
                    this.User = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getTeacherDetails() {
            axios
                .get("/student/getSingleTeacher/" + this.userId)
                .then((result) => {
                    this.teacherDetails = result.data;
                })
                .catch((err) => {});
        },
        buyHours(id,totalPrice){
            const lesson = {
                teacherId: id,
                totalPrice: totalPrice,
                booked_hours: this.lessonDetails[2].ADVANCED
            }
            console.log(lesson)
        }
    },
}
</script>

<style scoped>
.buyBtn{
    border: 1px solid #029e20;
    color: white;
    background: #029e02;
    padding: 2px 15px 4px;
    text-decoration: none;
    width: 75%;
}
.buyBtn:hover{
    background:#02ad25;
    color: white;
}
.totalPrice{
    font-size: 30px;
}
.numberOfLessons{
    font-size: 50px;
    font-weight: 550;
}
.textLessons{
    font-size: 25px;
    font-weight: lighter;
}
.Heading{
    font-size: 25px;
    font-weight: 550;
}
.HeadingContainer{
background: hsla(51, 88%, 46%, 1);

background: linear-gradient(90deg, hsla(51, 88%, 46%, 1) 0%, hsla(51, 100%, 50%, 1) 100%);

background: -moz-linear-gradient(90deg, hsla(51, 88%, 46%, 1) 0%, hsla(51, 100%, 50%, 1) 100%);

background: -webkit-linear-gradient(90deg, hsla(51, 88%, 46%, 1) 0%, hsla(51, 100%, 50%, 1) 100%);

filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#DFC00E", endColorstr="#FFD800", GradientType=1 );


}
.packageDetails{
    background-color: #f8f9fa;
}
.themeColor{
    color: #029e20;
}
.fa-circle-check{
    color: #029e20;
}
</style>