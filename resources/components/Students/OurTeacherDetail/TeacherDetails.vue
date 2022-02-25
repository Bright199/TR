<template>
    <div>
        <!--  -->
        <div class="m-0">
            <div class="row m-0 ">
                <div class="col-md-12 col-lg-12 col-sm-12 HoverTeacher">
                    <div class="row  pt-3">
                        <div class="col-md-3">
                            <img src="/images/Logo.png" alt="" width="150" />
                        </div>
                        <div class="col-md-6">
                            <p style="font-size:23px;font-weight: 550;">Bright P <i class="fa-solid fa-flag-checkered"></i></p>
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
                                <div class="col-md-4" style="font-size: 20px">
                                    <!-- <p>
                                        5 <br /><span style="font-size: 13px"
                                            >reviews</span
                                        >
                                    </p> -->
                                </div>
                                <div class="col-md-8" style="font-size: 20px">
                                    <p  style="font-size:23px;font-weight: 550;">
                                        $15 USD<br />
                                    </p>
                                    <p style="line-height:2px">per hour</p>
                                </div>
                            </div>
                            <br><br>
                            <a href="" class="btn d-block FilterBtn"
                                >Details</a
                            ><br />
                            <a href="" class="btn d-block btn-warning mb-3 RemoveOutline">Hire</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="m-0">
            <div class="row m-0 ">
                <div class="col-md-12 col-lg-12 col-sm-12 HoverTeacher">
                    <div class="row  pt-3">
                        <div class="col-md-3">
                            <img src="/images/Green2.png" alt="" width="150" />
                        </div>
                        <div class="col-md-6">
                            <p style="font-size:23px;font-weight: 550;">Bright P <i class="fa-solid fa-flag-checkered"></i></p>
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
                                <div class="col-md-4" style="font-size: 20px">
                                    <!-- <p>
                                        5 <br /><span style="font-size: 13px"
                                            >reviews</span
                                        >
                                    </p> -->
                                </div>
                                <div class="col-md-8" style="font-size: 20px">
                                    <p  style="font-size:23px;font-weight: 550;">
                                        $15 USD<br />
                                    </p>
                                    <p style="line-height:2px">per hour</p>
                                </div>
                            </div>
                            <br><br>
                            <a href="" class="btn d-block FilterBtn"
                                >Details</a
                            ><br />
                            <a href="" class="btn d-block btn-warning mb-3 RemoveOutline">Hire</a>
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
.btn{
    border-radius: 0
}
.FilterBtn {
    background-color: #029e02;
    color: white;
}
.FilterBtn:focus {
    outline: none;
    box-shadow: none;
}
.RemoveOutline:focus {
    outline: none;
    box-shadow: none;
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

.Horizontal {
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
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

.HoverTeacher:hover:not(img){
    background-color: rgb(21, 20, 25,0.05);
    cursor: pointer;
}
.HoverTeacher{
   border-bottom: 1px solid rgb(219, 219, 219);
   
}
</style>