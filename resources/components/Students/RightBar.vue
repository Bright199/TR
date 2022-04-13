<template>
    <div>
        <div class="LeftBar shadow-sm bg-white m-0">
            <div class="container border-bottom">
                <p class="TopHeading ps-4 pt-3">Available teachers</p>
            </div>
            <div class="">
                <!-- Ours Teachers -->
                <TeachersDetails v-if="showTeachersComponent === 0" />
                <!--  -->
                <!-- Other teachers -->
                <OtherTeacherDetails v-if="showTeachersComponent === 1" />
                <!--  -->
                <!-- teachers by price -->
                <TeachersByPrice v-if="showTeachersComponent === 4" />
                <!--  -->
                <!-- teachers by language -->
                <TeachersByLanguage v-if="showTeachersComponent === 2" />
                <!--  -->
                <!-- teachers by country -->
                <TeachersByCountry v-if="showTeachersComponent === 3" />
                <!--  -->
                <TeachersByName v-if="showTeachersComponent  === 5"/>              
            </div>
        </div>
    </div>
</template>
<script>
import JQuery from "jquery";
window.$ = JQuery;
import TeachersDetails from "./OurTeacherDetail/TeachersDetails.vue";
import OtherTeacherDetails from "./OtherTeacherDetail/OtherTeacherDetails.vue";
import TeachersByPrice from "./OurTeacherDetail/TeachersByPrice.vue";
import TeachersByLanguage from "./OurTeacherDetail/TeachersByLanguage.vue";
import TeachersByCountry from "./OurTeacherDetail/TeachersByCountry.vue";
import { mapState } from "vuex";
import TeachersByName from './OurTeacherDetail/TeachersByName.vue';
export default {
    name: "RightBar",
    components: {
        TeachersDetails,
        OtherTeacherDetails,
        TeachersByPrice,
        TeachersByLanguage,
        TeachersByCountry,
        TeachersByName,
    },
    data() {
        return {
            ActiveTeachersDiv: 0,
        };
    },
    methods: {
        ActivateOurTeacherDiv() {
            this.$store.commit("ActivateOurTeacherDiv");
        },
        ActivateOtherTeacherDiv() {
            this.$store.commit("ActivateOtherTeacherDiv");
        },
    },
    computed: {
        ...mapState({
            showTeachersComponent: (state) => state.showTeachersComponent,
        }),
    },
    mounted() {},
};
</script>
<style scoped>
.btn {
    border-radius: 0;
}
.OtherTeachersLink a {
    text-decoration: none;
    color: #151419;
}
.OurTeachersLinkActive {
    background-color: rgb(2, 158, 2, 0.1);
    padding: 2px;
    border: 1px solid #029e02;
}
.OurTeachersLinkActive:hover {
    cursor: pointer;
}
.OtherTeachersLink:hover {
    background-color: rgb(2, 158, 2, 0.2);
    padding: 2px;
    cursor: pointer;
}
.OurTeachersLink:hover {
    background-color: rgb(2, 158, 2, 0.1);
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
/* .LeftBar {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    -moz-box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
} */
.Horizontal {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
}
.TopHeading {
    color: #151419;
    margin-top: 5px;
    font-size: 18px;
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
