<template>
    <div>
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-2"></div>
            <div class="col-md-2 col-lg-8 col-sm-8 p-4 mt-3">
                <p class="text-center">
                    You can also buy custom number of hours.
                </p>
                <div class="container p-0 d-flex justify-content-center">
                    <button type="button" class="btn customBtn" data-bs-toggle="modal" data-bs-target="#customHours" @click="customHours(userId)">Buy custom hours</button>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2"></div>
        </div>
        <!-- Lesson modal -->
            <div class="modal fade" id="customHours" tabindex="-1" aria-labelledby="customHours" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-center" id="customHours">Select number of hours suitable for you!</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mb-4">
                        <p><span style="color:#029e20">Teacher: </span>{{teacherDetails.name}}</p>
                        <p><span style="color:#029e20">Teacher's fee:</span> ${{teacherDetails.hourly_pay}}/hour</p>
                        <p v-if="loaded"><span style="color:#029e20">Total fee: </span><span style="font-size: 25px">${{parseFloat(numberOfHours) * parseFloat(teacherDetails.hourly_pay)}}</span></p>
                    </div>
                    <div class="container p-3 mt-3">
                        <Slider
                        v-model="value"
                        class="slider-blue"
                        @update="getNumberHours"
                    />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn buyBtn" @click="buyHours(teacherDetails.id,parseFloat(numberOfHours) * parseFloat(teacherDetails.hourly_pay))">Buy Hours</button>
                </div>
                </div>
            </div>
            </div>

        <!-- end of modal -->
    </div>
</template>

<script>
import Slider from '@vueform/Slider';
import axios from 'axios';
export default {
    name: "CustomNumberOfLesson",
    props: ["userId"],
    components: {
        Slider,
    },
    data() {
        return {
            value: 12,
            loading2: false,
            loaded: false, 
            teacherDetails:'',
            numberOfHours: 12
        }
    },
    methods: {
        customHours(userId){
            axios.get("/student/getSingleTeacher/" + this.userId)
            .then((result)=>{
                this.teacherDetails = result.data;
                this.loaded = true
            })
            .finally(() => {
                this.loading2 = false;
            })
        },
        getNumberHours(){
            this.numberOfHours = this.value
        },
        buyHours(id,totalPrice)
        {
            const lesson = {
                teacherId: id,
                totalPrice: totalPrice,
                booked_hours: this.numberOfHours
            }
            axios.post("/student/paidLessonDetails",lesson)
            .then(()=>{
                window.location = '/student/payforhours'
            })
        }
    },
};
</script>

<style src="@vueform/slider/themes/default.css" ></style>
<style scoped>
.buyBtn{
    border: 1px solid #029e02;
    color: #029e02;
}
.buyBtn:hover{
    background: #029e02;
    color: white;
}
.customBtn {
    border: 1px solid #029e02;
    color: white;
    background-color: #029e02;
}
.btn:focus{
    outline: none;
    box-shadow: none;
}
.slider-blue {
    --slider-connect-bg: #029e02;
    --slider-tooltip-bg: #029e02;
    --slider-handle-ring-color: #029e0230;
}
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 10px;
    border-radius: 20px;
    background: #ececec;
    outline: none;
    opacity: 0.8;
    -webkit-transition: 0.2s;
    transition: opacity 0.2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: #029e02;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: #029e02;
    cursor: pointer;
}
</style>
