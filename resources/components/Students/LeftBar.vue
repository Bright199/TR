<template>
    <div>
        <div class="container LeftBar">
            <!-- post your first ad -->
            <div class="my-ad">
                <div class="d-flex justify-content-center">
                    <a href=""> Post an ad</a>
                </div>
            </div>
            <!-- Languages -->
            <form>
                <div>
                    <p>Filter by</p>
                    <h5>Language</h5>
                    <select class="form-select mt-3">
                        <option>English</option>
                        <option>French</option>
                        <option>Germany</option>
                        <option>Turkish</option>
                    </select>
                </div>
                <br />
                <div>
                    <h5>Country</h5>
                    <select class="form-select mt-3">
                        <option>English</option>
                        <option>French</option>
                        <option>Germany</option>
                        <option>Turkish</option>
                    </select>
                </div><br>
                <div>
                    <a href="" type="submit" class="btn d-block FilterBtn">Filter results</a>
                </div>
            </form>
            
        </div>
    </div>
</template>
<script>
export default {
    name: "LeftBar",
};
</script>
<style scoped>
.LeftBar {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    /* padding: 10px; */
    height: 500px;
}
.my-ad {
    background-color: #f6f2e9;
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
    color: #f6f2e9;
    font-size: 20px;
    padding: 5px;
}
</style>
