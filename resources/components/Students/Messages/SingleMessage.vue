<template >
    <div>
        <DashboardNavBar/>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-3  me-3 shadow-sm LeftContainer">
                    
                </div>
                <div class="col-md-8 mt-3  shadow-sm MainContainer">

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DashboardNavBar from "../DashboardNavBar.vue";
export default {
    name:'SingleMessage',
    components: {DashboardNavBar},
    props:['id'],
    data() {
        return {
            
        }
    },
}
</script>
<style scoped>
.MainContainer{
    height: 450px;
}
.LeftContainer{
    height: 250px;
}
</style>