<template>
    <div>
        <button
            type="button"
            class="AllTeachersBtn"
            @click="getTeachersDetails"
        >
            All teachers
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
    background-color: white;
    border: 1px solid #029e02;
    border-radius: 3px;
}
.AllTeachersBtn:hover {
    background-color: #f8f9fa;
}
</style>
