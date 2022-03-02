<template>
    <div>
        <DashboardNavBar/>
        <h2>Favorites</h2>
    </div>
</template>
<script>
import axios from 'axios';
import DashboardNavBar from '../DashboardNavBar.vue'
export default {
    name:'Messages',
    components: {DashboardNavBar}
}
</script>