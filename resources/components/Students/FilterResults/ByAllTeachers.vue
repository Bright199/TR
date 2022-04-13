<template>
    <div>
        <h5>All teachers</h5>
        <button
            type="button"
            class="AllTeachersBtn"
            @click="getTeachersDetails"
        >
            show all teachers
        </button>
    </div>
</template>

<script>
export default {
    name: "ByAllTeachers",
    methods: {
        getTeachersDetails() {
            this.$store.commit('ActivateOurTeacherDiv')
        },
    },
};
</script>

<style>
.AllTeachersBtn {
    width: 100%;
    background-color: #029e02;
    border: 1px solid #029e02;
    border-radius: 3px;
    padding: 0px 0px 2px;
    color: white;
}
.AllTeachersBtn:hover {
    background-color: white;
    color: #183153;
}
</style>
