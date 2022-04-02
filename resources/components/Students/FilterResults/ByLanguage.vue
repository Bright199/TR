<template>
    <div>
        <h5>Language</h5>
        <select
            class="form-select form-select-sm mt-3"
            v-model="language"
            @change="SelectLanguage"
        >
            <option>Arabic</option>
            <option>Bengali</option>
            <option>Chinese</option>
            <option>English</option>
            <option>French</option>
            <option>Germany</option>
            <option>Greek</option>
            <option>Hebrew</option>
            <option>Hindi</option>
            <option>Indonesian</option>
            <option>Italian</option>
            <option>Japanese</option>
            <option>Polish</option>
            <option>Portugese</option>
            <option>Romanian</option>
            <option>Russian</option>
            <option>Spanish</option>
            <option>Turkish</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "ByLanguage",
    data() {
        return {
            language: "Arabic",
        };
    },
    methods: {
        SelectLanguage() {
            this.$store.commit({
                type: "getTeachersByLanguage",
                language: this.language,
            });
        },
    },
};
</script>

<style scoped>
select:focus {
    outline: none !important;
}
select {
    border: 1px solid #029e02;
}
select option:hover {
    background-color: #029e02;
}
</style>
