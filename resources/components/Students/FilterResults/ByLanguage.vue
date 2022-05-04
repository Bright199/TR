<template>
    <div>
        <h5>Language</h5>
        <select
            class="form-select form-select-sm mt-3"
            v-model="language"
            @change="SelectLanguage"
        >
            <option disabled value="Select language">Select language</option>
           <option v-for="(lang, index) in languages" :key="index">{{lang}}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "ByLanguage",
    data() {
        return {
            language: "Select language",
            languages:[
                'Arabic',
                'Bengali',
                'Catalan',
                'Croatian',
                'Czech',
                'Danish',
                'Dutch',
                'English',
                'French',
                'German',
                'Greek',
                'Hebrew',
                'Hindi',
                'Hungarian',
                'Indonesian',
                'Italian',
                'Japanese',
                'Latin',
                'Norwegian',
                'Persian',
                'Polish',
                'Portugese',
                'Romanian',
                'Russian',
                'Serbian',
                'Spanish',
                'Swahili',
                'Swedish',
                'Thai',
                'Turkish',
                'Ukranian',
                
            ],
        };
    },
    mounted() {
        this.setLanguage()
    },
    methods: {
        setLanguage() {
            this.$store.commit({
                type: "setLanguage",
                language: this.language,
            });
        },
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
.form-select:focus{ 
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}

</style>
