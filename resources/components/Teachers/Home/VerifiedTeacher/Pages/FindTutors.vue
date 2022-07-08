<template>
    <div class="p-2">
        <NavBar :findTutorsComponent="findTutorsComponent"/>
    </div>
</template>

<script>
import NavBar from '../NavBar.vue';
    export default {
    name: "FindTutors",
    components: { NavBar },
    data() {
        return {
            findTutorsComponent: false
        }
    },
    mounted () {
        this.findTutorsComponent = true;
    },
}
</script>

<style lang="scss" scoped>

</style>