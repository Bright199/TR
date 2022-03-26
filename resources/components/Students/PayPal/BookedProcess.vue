<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p>
                        It seems you have already booked or started to book a demo lesson with
                        <a
                            :href="'/student/book/demo/payment/' + teacherDetails.id"
                            >{{ teacherDetails.name }}</a
                        >
                    </p>
                    <div class="container bg-white p-4">
                        <div class="row navBtns">
                            <div class="col-md-4">
                                <router-link to="/student/all/demo/lessons"
                                   class="d-flex justify-content-center mb-2" >My demo lessons</router-link
                                >
                            </div>
                            <div class="col-md-4">
                                <router-link to="/student/incomplete/demo/booking"
                                    class="d-flex justify-content-center mb-2">Incomplete booking</router-link
                                >
                            </div>
                            <div class="col-md-4">
                                <router-link to="/student/teachers"
                                    class="d-flex justify-content-center mb-2">Browse teachers</router-link
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BookedProcess',
    props: ['teacherDetails'],
    
};
</script>

<style>
.navBtns a{
    text-decoration: none;
    padding:5px 15px 7px;
    background-color: #029e02;
    color:white
}
</style>
