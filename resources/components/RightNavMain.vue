<template>
    <div class="rightNav">
        <ul class="">
            <li>
                <a href="">HIRE A TEACHER</a>
            </li>
            <li>
                <a href="">WORK FROM HOME</a>
            </li>
            <li>
                <a href="">ORGANISATION</a>
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
import LanguagesOffered from './RightNav/LanguagesOffered.vue';
import OtherServices from './RightNav/OtherServices.vue';
import PricesOfLesson from './RightNav/PricesOfLesson.vue';
export default {
  components: { OtherServices, LanguagesOffered, PricesOfLesson },
    name: "RightNavMain",
};
</script>
<style scoped>
.rightNav li {
    list-style-type: none;
    padding: 10px;
    background-color: #fec107;
    text-align: center;
    width: 70%;
    margin-bottom: 8px;
    margin-left: auto;
    margin-right: auto;
}
.rightNav li:hover {
    background-color: #fec107;
}
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
