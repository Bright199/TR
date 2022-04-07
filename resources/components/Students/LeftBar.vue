<template>
    <div>
        <div class="container LeftBar shadow-sm bg-white">
            <!-- post your first ad -->
            <div
                class="d-flex justify-content-center align-content-center p-3 border-bottom"
            >
                <a href="/student/create/ad"><h6>Post an ad</h6></a>
            </div>
            <p class="pt-2" style="color: #029e02">Filter by</p>

            <form>
                <div>
                    <ByAllTeachers />
                </div>
                <br />
                <!--  -->
                <div>
                    <ByLanguage />
                </div>
                <br />
                <!--  -->
                <div>
                    <ByCountry />
                </div>
                <br />
                <!--  -->
                <div>
                    <ByPrice />
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import ByPrice from "./FilterResults/ByPrice.vue";
import ByCountry from "./FilterResults/ByCountry.vue";
import ByLanguage from "./FilterResults/ByLanguage.vue";
import ByAllTeachers from "./FilterResults/ByAllTeachers.vue";
export default {
    name: "LeftBar",
    components: { ByLanguage, ByCountry, ByPrice, ByAllTeachers },
    data() {
        return {};
    },
    mounted() {},
    methods: {},
};
</script>
<style scoped>
.LeftBar {
    /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    -moz-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; */
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
