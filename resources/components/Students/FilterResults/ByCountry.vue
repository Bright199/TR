<template>
    <div>
        <h5>Country</h5>
        <select
            class="form-select form-select-sm mt-3"
            @change="FilterByCountry"
        >
            <option
                v-for="(country, index) in countriesInfo"
                :key="index"
                :value="country.value"
            >
                {{ country.name }}
            </option>
        </select>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "ByCountry",
    data() {
        return {
            countriesInfo: [],
            country: 'Afghanistan'
        };
    },
    mounted() {
        axios
            .get("https://countriesnow.space/api/v0.1/countries/flag/images")
            .then((response) => {
                this.countriesInfo = response.data.data;
            });
    },
    methods: {
        FilterByCountry(){
           this.$store.commit({
                type: "getTeachersByCountry",
                country: this.country,
            });
        } 
    }
};
</script>

<style scoped>
select:focus{
    outline: none ;
}
select{
    border: 1px solid #029e02;
}

</style>
