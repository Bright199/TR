<template>
    <div>
        <DashboardNavBar />
        <!-- {{id}} -->
    </div>
</template>
<script>
import DashboardNavBar from './DashboardNavBar.vue'
export default {
    name:'SingleTeacher',
    props:['id'],
    components: {
        DashboardNavBar
    }
}
</script>