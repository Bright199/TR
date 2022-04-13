<template>
    <div>
        <h5>Search teacher</h5>
        <div class="input-group">
            <input
                type="text"
                class="form-control form-control-sm"
                placeholder="Teacher's name..."
                v-model="teacherName"
            />
            <button @click.prevent="TeacherName" class="SearchBtn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ByTeacherName",
    data() {
        return {
            teacherName: "",
        };
    },
    methods: {
        TeacherName() {
            const teacherName = this.teacherName.trim();
            if (teacherName === "") {
                alert("Input empty");
            } else {
                this.$store.commit({
                    type: "getTeachersByName",
                    name: teacherName,
                });
            }
        },
    },
};
</script>

<style>
.form-control:focus {
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}
.SearchBtn {
    background: #029e02;
    color: white;
    border: none;
}
</style>
