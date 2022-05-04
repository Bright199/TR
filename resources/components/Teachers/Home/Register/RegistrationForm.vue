<template>
    <div>
        <div class="container-jumbotron">
            <RegisterNav />
        </div>
        <div class="container-jumbotron mt-2">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-lg-2"></div>
                <div class="col-md-8 col-sm-8 col-lg-8 p-0">
                    <About v-if="showTeacherRegistrationFormComponent === 0" />
                    <Description
                        v-if="showTeacherRegistrationFormComponent === 1"
                    />
                    <Qualification
                        v-if="showTeacherRegistrationFormComponent === 2"
                    />
                    <Video v-if="showTeacherRegistrationFormComponent === 3" />
                    <Availability v-if="showTeacherRegistrationFormComponent === 4" />
                </div>
                <div class="col-md-2 col-sm-2 col-lg-2"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import About from "./FormComponents/About.vue";
import Availability from "./FormComponents/Availability.vue";
import Description from "./FormComponents/Description.vue";
import Qualification from "./FormComponents/Qualification.vue";
import Video from "./FormComponents/Video.vue";
import RegisterNav from "./RegisterNav.vue";
export default {
    components: {
        RegisterNav,
        About,
        Availability,
        Description,
        Qualification,
        Video,
    },
    name: "Registration Form",
    data() {
        return {};
    },
    mounted() {},
    methods: {},
    computed: {
        ...mapState({
            showTeacherRegistrationFormComponent: (state) =>
                state.showTeacherRegistrationFormComponent,
        }),
    },
};
</script>

<style></style>
