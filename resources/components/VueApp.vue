<template>
    <div class="">
        <!-- <RightNavMain @alert-showing="Working()" /> -->
        <!-- <NavBar/> -->
        <!-- {{Working()}} -->
        <router-view></router-view>
    </div>        
</template>
<script>
// import RightNavMain from './RightNavMain.vue'
// import NavBar from '../components/Students/NavBar.vue'
// import Home from './Home.vue'
// import Workers from './Workers/Workers.vue'
export default {
    name: "VueApp",
    // components:{
        // RightNavMain,
        // NavBar
    // },
    // data() {
    //     return {
    //         workingOne:'one'
    //     }
    // },
    // methods: {
    //     Working(){
    //      alert(this.workingOne)
    //     }
    // },
//    mounted() {
//        this.Working()
//    }
}
</script>