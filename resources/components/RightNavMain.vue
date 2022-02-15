<template>
    <div class="rightNav">
        <!--  -->
        <ul class="" v-if="CheckUrl=='/teacher/home'">
            <li >
                <a href="/student/home">Hire a tutor</a>
            </li>
            <!-- <li >
                <a href="/teacher/home">Work from home</a>
            </li> -->
            <li>
                <a href="">Organizations</a>
            </li>
        </ul>
        <!--  -->
        <ul class="" v-else-if="CheckUrl=='/student/home'">
            <!-- <li >
                <a href="/student/home">Hire a teacher</a>
            </li> -->
            <li v-if="CheckUrl=='/student/home'">
                <a href="/teacher/home">Work from home</a>
            </li>
            <li>
                <a href="">Organizations</a>
            </li>
        </ul>
        <!--  -->
        <ul class="" v-else>
            <li >
                <a href="/student/home">Hire a tutor</a>
            </li>
            <li >
                <a href="/teacher/home">Work from home</a>
            </li>
            <li>
                <a href="">Organizations</a>
            </li>
        </ul>
    </div>
    <!-- Other services -->
    <div class="container">
        <OtherServices />
    </div>
    <hr style="height: 10px" />
    <!-- Languages -->
    <div class="container">
        <LanguagesOffered />
    </div>
    <hr style="height: 10px" />
    <!-- Prices -->
    <div class="container">
        <PricesOfLesson />
    </div>
    <hr style="height: 10px" />
</template>
<script>
import LanguagesOffered from "./RightNav/LanguagesOffered.vue";
import OtherServices from "./RightNav/OtherServices.vue";
import PricesOfLesson from "./RightNav/PricesOfLesson.vue";
export default {
    name: "RightNavMain",
    components: { OtherServices, LanguagesOffered, PricesOfLesson },
    data() {
        return {
            CheckUrl:''
        }
    },
    mounted() {
        var currentUrl = window.location.pathname;
        this.CheckUrl = currentUrl
        // console.log(window.location.origin);
    },
};
</script>
<style scoped>
.rightNav li {
    list-style-type: none;
    padding: 6px;
    background-color: #fec107;
    text-align: center;
    /* width: 70%; */
    margin-bottom: 8px;
    margin-left: auto;
    margin-right: auto;
}
.rightNav li:hover {
    background-color: #fed907;
}
/* .rightNav li a:hover {
    background-color: #fec107;
} */
.rightNav li a {
    text-decoration: none;
    font-size: 20px;
    color: #151419;
}
.rightNav ul {
    padding: 0px;
    /* background-color: #d9d9d9;
  height: 400px; */
}
</style>
