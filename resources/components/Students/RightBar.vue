<template>
    <div>
        <div class="LeftBar m-0">
            <div class="container p-2 mt-3">
                <p class="TopHeading p-1">Available teachers</p>
            </div>
            <!-- <hr class="Horizontal" /> -->
            <div class="container mb-3 border-bottom">
                <div class="row">
                    <div
                        @click="ActiveTeacherDiv(0)"
                        class="col-md-4 d-flex pt-2 justify-content-center OurTeachersLink"
                        :class="
                            ActiveTeachersDiv == 0
                                ? 'OurTeachersLinkActive'
                                : ''
                        "
                    >
                        <h4>Our teachers</h4>
                    </div>
                    <div
                        @click="ActiveTeacherDiv(1)"
                        class="col-md-4 d-flex pt-2 justify-content-center OtherTeachersLink"
                        :class="
                            ActiveTeachersDiv == 1
                                ? 'OurTeachersLinkActive'
                                : ''
                        "
                    >
                        <h4>Freelance teachers</h4>
                    </div>
                </div>
            </div>
            <div class="">
                <!-- Ours Teachers -->
                <TeachersDetails v-if="ActiveTeachersDiv == 0" />
                <!--  -->
                <!-- Other teachers -->
                <OtherTeacherDetails v-if="ActiveTeachersDiv == 1" />
                <!--  -->
            </div>
        </div>
    </div>
</template>
<script>
import TeachersDetails from "./OurTeacherDetail/TeacherDetails.vue";
import OtherTeacherDetails from "./OtherTeacherDetail/OtherTeacherDetails.vue";
export default {
    name: "RightBar",
    components: {
        TeachersDetails,
        OtherTeacherDetails,
    },
    data() {
        return {
            ActiveTeachersDiv: 0,
        };
    },
    methods: {
        ActiveTeacherDiv(value) {
            this.ActiveTeachersDiv = value;
        },
    },
};
</script>
<style scoped>
.btn{
    border-radius: 0
}
.OtherTeachersLink a {
    text-decoration: none;
    color: #151419;
}
.OurTeachersLinkActive {
    background-color: rgba(0, 0, 0, 0.1);
    padding: 2px;
}
.OurTeachersLinkActive:hover {
    cursor: pointer;
}
.OtherTeachersLink:hover {
    background-color: rgba(0, 0, 0, 0.1);
    padding: 2px;
    cursor: pointer;
}
.OurTeachersLink:hover {
    background-color: rgba(0, 0, 0, 0.1);
    padding: 2px;
    cursor: pointer;
}
.OurTeachersLink a {
    text-decoration: none;
    color: #151419;
}

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
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
}
.TopHeading {
    color: #151419;
    margin-top: 5px;
    font-size: 22px;
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
