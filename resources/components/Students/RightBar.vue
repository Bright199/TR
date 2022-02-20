<template>
    <div>
        <div class="LeftBar m-0">
            <div class="container mt-3">
                <p class="TopHeading p-1">Available teachers</p>
            </div>
            <hr class="Horizontal" />
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                <a href="/student/ourteachers/list"><h4>Hire Our teachers</h4></a>

                    </div>
                    <div class="col-md-4">
                <a href="/student/ourteachers/list"><h4>Hire Other teachers</h4></a>

                    </div>
                </div>
            </div>
            <!-- Ours Teachers -->
            <div class="">
                <!--  -->
                <TeachersDetails />
                <TeachersDetails />
                <!--  -->
            </div>
        </div>
    </div>
</template>
<script>
import TeachersDetails from "./OurTeacherDetail/TeacherDetails.vue";
export default {
    name: "RightBar",
    components: {
        TeachersDetails,
        // NavBar
    },
};
</script>
<style scoped>
.MainFluencyLevel {
    color: #029e02;
    background-color: rgb(2, 158, 2, 0.1);
    padding: 4px;
    border-radius: 5px;
}
.FluencyLevel {
    color: #027a9e;
    background-color: rgba(2, 83, 158, 0.1);
    padding: 4px;
    border-radius: 5px;
}
.LeftBar {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
}
.Horizontal {
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}
.TopHeading {
    color: #151419;
    margin-top: 5px;
    font-size: 22px;
}
.OurTeachers {
    /* height: 300px;
    overflow-y: scroll; */
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

.cardShadow {
    box-shadow: 17px 24px 16px -26px rgba(0, 0, 0, 0.53);
    -webkit-box-shadow: 17px 24px 16px -26px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 17px 24px 16px -26px rgba(0, 0, 0, 0.53);
}
</style>
