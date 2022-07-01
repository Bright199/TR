<template>
    <div>
        <div class="nav-bar under-verification-navbar p-3">
            <a href="/teacher/logout">
                Logout <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
        <div class="row mt-5">
            <div class="col-md-3"></div>
            <div class="col-md-6 p-5 bg-white">
                <div class="container border-bottom">
                    <h4 style="color: #029e20">WHAT NEXT?</h4>
                    <p>Dear <span style="color:#029e20">{{ TeacherDetails.name }},</span> your application is under
                        evaluation.</p>
                    <p>We understand you want to start earning good money as soon as possible and we promise you that
                        your
                        account
                        will be approved soon!</p>
                    <p><span class="text-info">NOTE:</span> This may take few minutes or few hours depending on our work
                        load.<i style="color: #FFEB3B" class="fa-solid fa-face-smile"></i></p>
                </div>
                <div class="container pt-3">
                    <h4 style="color: #029e20">WHAT CAN I DO AS I WAIT?</h4>
                    <p>Some of the things you can do for now:</p>
                    <ul>
                        <li>
                            Checking out some of our teachers to learn some ideas:
                            <ul>
                                <li>
                                    <a href="/teacher/allteachers">TREnglish Teachers</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            Getting ready for your first lesson.
                            <ul>
                                <li>
                                    Prepare your classroom gadgets like computer and headphone or microphone.
                                </li>
                                <li>
                                    Plan your first lesson contents (e.g. grammar, vocabulary, speaking, listening).
                                </li>
                            </ul>
                        </li>
                        <li>
                            Read our policies and documentations to have clear idea how to work on TREnglish.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'TeacherUnderVerification',
    data() {
        return {
            TeacherDetails: ''
        }
    },
    methods: {
        getTeacherDetails() {
            axios.get('/teacher/getTeacherDetails')
                .then((res) => {
                    this.TeacherDetails = res.data
                })
        }
    },
    mounted() {
        this.getTeacherDetails()

    },
}
</script>

<style scoped>
body {
    background: #183153;
}

.nav-bar {
    display: flex;
    justify-content: flex-end;
    background-color: white;
}

.nav-bar a {
    text-decoration: none;
    color: #029e20;
}

.nav-bar a:hover {
    color: #183153;
}
</style>