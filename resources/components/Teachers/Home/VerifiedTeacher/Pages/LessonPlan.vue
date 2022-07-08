<template>
    <div class="p-2">
        <NavBar :lessonPlanComponent="lessonPlanComponent"/>
    </div>
</template>

<script>
import NavBar from '../NavBar.vue';
    export default {
    name: "LessonPlan",
    components: { NavBar },
    data() {
        return {
            lessonPlanComponent: false
        }
    },
    mounted () {
        this.lessonPlanComponent = true
    },
}
</script>

<style lang="scss" scoped>

</style>