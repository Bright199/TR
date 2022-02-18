<template>
    <div class="container-jumbotron ">
        <nav class="navbar navbar-expand-sm TopBar navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/student/home">
                <img src="https://img.icons8.com/ios-filled/30/151419/home.png"/>
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="LinkItem" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class=" LinkItem" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="LinkItem" href="#">Link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "NavBar",
    props: ["user"],
    data() {
        return {};
    },
    mounted() {
        // alert('working')
    },
    computed: mapState({
        count: (state) => state.count,
    }),
};
</script>
<style scoped>
.TopBar {
    background-color: #fed907;
}
.LinkItem {
   font-size: 18px;
    color: #151419;
    padding: 2px 10px;
}

</style>
