<template>
    <div>
        <div class="container-jumbotron shadow-sm py-3">
            <div class="row">
                <div class="col-md-4 ms-3">
                    <router-link to="/student/dashboard" class="DashboardClass">
                        <i class="fa-solid fa-angle-left"></i>
                        &nbsp;Dashboard
                    </router-link>
                </div>
                <div class="col-md-7">
                    <ul class="d-flex CrumbContainer">
                        <li class="activeCrumb text-center">1. Select time</li>
                        <li class="text-center">
                            <i class="fa-solid fa-angle-right"></i>
                        </li>
                        <li class="text-center">2. Make a payment</li>
                        <li class="text-center">
                            <i class="fa-solid fa-angle-right"></i>
                        </li>
                        <li class="text-center">3. Prepare your lesson</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "PayPal",
};
</script>
<style scoped>
.activeCrumb {
    font-weight: 550;
    list-style: none;
    margin-right: 10px;
}
.CrumbContainer li:not(.activeCrumb) {
    list-style: none;
    margin-right: 10px;
    color: #79787c;
}
.CrumbContainer {
    flex-wrap: wrap;
}
.fa-angle-left {
    color: #fec107;
}
.DashboardClass {
    font-size: 18px;
    color: #151419;
    text-decoration: none;
}
</style>
