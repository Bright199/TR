<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p>
                        It seems you have already booked a demo lesson with
                        <router-link
                            :to="'/student/single/teacher/' + teacherDetails.id"
                            >{{ teacherDetails.name }}</router-link
                        >
                    </p>
                    <div class="container bg-white p-4">
                        <div class="row navBtns">
                            <div class="col-md-4">
                                <router-link to="/student/all/demo/lessons"
                                    >My demo lessons</router-link
                                >
                            </div>
                            <div class="col-md-4">
                                <router-link to="/student/our/teacher"
                                    >Browse teachers</router-link
                                >
                            </div>
                            <div class="col-md-4">
                                <router-link to="/student/our/teachers"
                                    >Incomplete booking</router-link
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
    props: ['teacherDetails']
};
</script>

<style>
.navBtns a{
    text-decoration: none;
    padding:8px;
    background-color: #f0e260;
    color:#151419
}
</style>
