<template>
    <div>
        <DashboardNavBar/>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4 LeftBar">
                    <div class="container-jumbotron d-flex justify-content-center p-3">
                    <h3>List of teachers</h3>
                    </div>
                </div>
                <div class="col-md-8 RightBar">
                     <h3>List of message conversation</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import DashboardNavBar from '../DashboardNavBar.vue'
export default {
    name:'Messages',
    components: {DashboardNavBar}
}
</script>
<style scoped>
.LeftBar {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);

    height: 450px;
    overflow-y: scroll;
}
.RightBar {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
}
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #e6e6e6;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #fe0609;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #ec0408;
    cursor: pointer;
}
</style>