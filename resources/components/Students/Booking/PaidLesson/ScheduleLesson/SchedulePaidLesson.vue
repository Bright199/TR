<template>
    <div>
        <div class="container-jumbotron">
            <MessageComponent v-if="modalState === true"/>
            <SingleMessageComponent v-if="singleModalState === true" />
        </div>
        <div class="container p-3">
            <div class="row" v-if="loaded">
                <div class="col-md-3 col-sm-3 col-lg-3 bg-white p-4 TeacherProfile">
                    <div class="container d-flex justify-content-center justify-items-center">
                        <img v-if="teacherDetails.teacher_image !== null" :src="'/images/'+teacherDetails.teacher_image" alt="teacher_image" class="rounded-circle" width="75" height="75">
                        <img v-else src="/images/avatar.png" alt="teacher_image" class="rounded-circle" width="75" height="75">
                    </div>
                    <p class="text-center">{{ teacherDetails.name}}</p>
                    <div class="container Details">
                        <p>Language <span style="color: #029e20">{{ teacherDetails.first_language}}</span></p>
                        <p>Hourly fee <span style="color: #029e20">${{ teacherDetails.hourly_pay}}/hour</span></p>
                        <p>Language <span style="color: #029e20">{{ teacherDetails.first_language}}</span></p>
                        <p v-if="teacherDetails.online === 1">Online <span style="color: #029e20">Yes</span></p>
                        <p v-else>Online <span style="color: #029e20">No</span></p>
                    </div>
                    <div class="container d-flex justify-content-end">
                        <button class="btn btn-success" @click="OpenMessageModal">Message</button>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 bg-white mx-3 p-4">
                    Teacher's calendar
                </div>
                <div class="col-md-2 col-sm-2 col-lg-2 bg-white p-4">
                    <p>Links</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import MessageComponent from '../../../Messages/MessageComponent.vue';
import SingleMessageComponent from '../../../Messages/SingleMessageComponent.vue';
import { mapState } from 'vuex';
export default {
  components: { MessageComponent, SingleMessageComponent },
    name: "SchedulePaidLesson",
    props: ["id"],
    data() {
        return {
            loading: false,
            loaded: false,
            teacherDetails:''
        }
    },
    mounted() {
        this.getTeacherDetails()
    },
    methods: {
        OpenMessageModal() {
            this.$store.commit("MessageModalPopup");
        },
        getTeacherDetails(){
            this.loading = true
            axios.get("/student/getTeacherDetails/"+ this.id)
            .then((response)=>{
                this.teacherDetails = response.data;
                this.loaded = true
            })
            .finally(() => {
                this.loading = false
            })
        }
    },
    computed: {
        ...mapState({
            modalState: (state) => state.openModal,
            singleModalState: (state) => state.openSingleModal,
        })
    },
};
</script>

<style>
.TeacherProfile{
    height: 350px;
    overflow-y: auto;
}
</style>
