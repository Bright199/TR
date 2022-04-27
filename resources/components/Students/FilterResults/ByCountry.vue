<template>
    <div>
        <h5>Country</h5>
        <select
            class="form-select form-select-sm mt-3"
            @change="FilterByCountry"
            v-model="country"
        >
            <option disabled value="Select country">Select country</option>
            <option
                v-for="country in countriesInfo"
                :value="country.name"
                :key="country"
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
            country: 'Select country'
        };
    },
    mounted() {
        this.getCountryApi();
    },
    methods: {
        getCountryApi(){
            this.$store.commit({
                type: "setCountry",
                country: this.country
            });
            axios
            .get("https://countriesnow.space/api/v0.1/countries/flag/images")
            .then((response) => {
                this.countriesInfo = response.data.data;
            });
        },
        FilterByCountry(){
           this.$store.commit({
                type: "getTeachersByCountry",
                country: this.country
            });
        } 
    }
};
</script>

<style scoped>
.form-select:focus{ 
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}
</style>
