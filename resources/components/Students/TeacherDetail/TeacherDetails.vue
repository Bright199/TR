<template>
    <div>
        <!--  -->
        <div class="d-fl">
            <div class="row ">
                <div class="col-md-10 card shadow-sm HoverTeacher">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/images/Green2.png" alt="" width="150" />
                        </div>
                        <div class="col-md-6">
                            <p>Bright P <i class="fa-solid fa-flag-checkered"></i></p>
                            <!-- <span style="font-size:bolder">Malawi </span> -->
                            <p>
                                <i class="fa-solid fa-chalkboard-user"></i
                                >&nbsp;English
                            </p>
                            <p>
                                Speaks: <span>English</span>
                                <span class="MainFluencyLevel">Native</span>
                                French
                                <span class="FluencyLevel">Intermediate</span>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit. Unde eum culpa est magni
                                nobis? Ipsum alias nostrum incidunt eaque
                                architecto! Quam est a <a href="" class="text-success">Read More</a>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6" style="font-size: 20px">
                                    <p>
                                        5 <br /><span style="font-size: 13px"
                                            >reviews</span
                                        >
                                    </p>
                                </div>
                                <div class="col-md-6" style="font-size: 20px">
                                    <p>
                                        90TL <br /><span style="font-size: 13px"
                                            >per hour</span
                                        >
                                    </p>
                                </div>
                            </div>
                            <a href="" class="btn d-block btn-success"
                                >Details</a
                            ><br />
                            <a href="" class="btn d-block btn-warning">Hire</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </div>
</template>
<script>
export default {
    name: "TeacherDetails",
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
    /* padding: 10px; */
    /* height: 500px; */
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
    height: 300px;
    overflow-y: scroll;
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

.HoverTeacher:hover:not(img){
    background-color: rgb(21, 20, 25,0.05);
    cursor: pointer;
}
</style>