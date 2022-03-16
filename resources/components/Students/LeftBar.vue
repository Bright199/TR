<template>
    <div>
        <div class="container  LeftBar">
            <!-- post your first ad -->
            <div class="d-flex justify-content-center pt-5 mt-3">
                
                <a href="/student/create/ad"><h6>Post an ad</h6></a>
            </div>
            <!-- <hr class="Horizontal"> -->
            <br /><br />
            <!-- Languages -->
            <form>
                <div>
                    <p>Filter by</p>
                    <h5>Language</h5>
                    <select class="form-select form-select-sm mt-3">
                        <option>English</option>
                        <option>French</option>
                        <option>Germany</option>
                        <option>Turkish</option>
                    </select>
                </div>
                <br />
                <div>
                    <h5>Country</h5>
                    <select class="form-select form-select-sm mt-3">
                        <option
                            v-for="(country, index) in countriesInfo"
                            :key="index"
                            :value="country.value"
                        >
                            {{ country.name }}
                            <!-- <span type='hidden'>{{ country.flag}}</span> -->
                        </option>
                    </select>
                </div>
                <br />
                <div>
                    <a href="" type="submit" class="btn d-block FilterBtn"
                        >Filter results</a
                    >
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "LeftBar",
    data() {
        return {
            countriesInfo: [],
        };
    },
    mounted() {
        const thisValue = this;
        axios
            .get("https://countriesnow.space/api/v0.1/countries/flag/images",{
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
            .then(function (response) {
                thisValue.countriesInfo = response.data.data;
                // console.log(response)
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
</script>
<style scoped>
.LeftBar {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    -moz-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
   /* padding: 10px; */
    height: 500px;
}
.my-ad {
    /* background-color: #f6f2e9; */
    padding: 5px;
}

.LanguageSelection {
    list-style: none;
    margin-top: 25px;
}
.CountrySelection {
    list-style: none;
    margin-top: 25px;
}
.FilterBtn {
    background-color: #029e02;
    color: white;
}
.FilterBtn:focus {
    outline: none;
    box-shadow: none;
}
.FilterBtn:hover {
    background-color: #038b03;
}
.Horizontal {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
}
.btn {
    border-radius: 0;
}
</style>
