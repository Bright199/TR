<template>
    <div>
        <!-- navbar -->
        <div>
            <NavBar />
        </div>
        <div class="dashboard-body p-2">
            <MainDashboard :teacherDetails ='teacherDetails'/>
        </div>
    </div>
</template>

<script>
import NavBar from './NavBar.vue'
import MainDashboard from './Pages/MainDashboard.vue'
export default {
    props:['teacherDetails'],
    data() {
        return {
        }
    },
    components: {
    NavBar,
    MainDashboard
},
    methods: {
        name() {

        }
    },
}
</script>

<style lang="scss" scoped>
</style>