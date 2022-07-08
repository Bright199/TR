<template>
    <div class="p-2">
        <NavBar :findStudentsComponent="findStudentsComponent"/>
    </div>
</template>

<script>
import NavBar from '../NavBar.vue';
    export default {
    name: "FindStudents",
    components: { NavBar },
    data() {
        return {
            findStudentsComponent: false
        }
    },
    mounted () {
        this.findStudentsComponent = true
    },
}
</script>

<style lang="scss" scoped>

</style>