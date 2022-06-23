<template>
    <div class="col-md-8 d-flex flex-column justify-content-center">
        <h3>{{getLocalStorageDayMessage()}} saved successfully</h3>
        <p style="color: #029e20; font-size: 55px;" class="text-center"><i class="fa-solid fa-thumbs-up"></i></p>
    </div>
</template>

<script>
export default {
    name: 'RecordSavedMessage',
    methods: {
        getLocalStorageDayMessage(){
           return localStorage.getItem('DayMessage')
        }
    },
    mounted() {
        this.getLocalStorageDayMessage()
    },
}
</script>

<style>
</style>