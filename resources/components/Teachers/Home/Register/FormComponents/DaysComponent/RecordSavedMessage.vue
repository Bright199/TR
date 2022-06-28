<template>
    <div class="col-md-8 p-5">
        <p class="text-center">{{getLocalStorageDayMessage()}} saved successfully</p>
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