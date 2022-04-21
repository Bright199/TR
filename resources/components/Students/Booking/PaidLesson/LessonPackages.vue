<template>
    <div>
        <div class="container-jumbotron bg-white">
            <Header />
        </div>
        <div class="p-4">
            <div class="row bg-white p-4 d-flex justify-content-center" >
                <Starter :userId="id" />
                <Pro :userId="id" />
                <Advanced :userId="id" />
            </div>
            <CustomNumberOfLesson :userId="id"/>
        </div>
    </div>
</template>

<script>
import Header from "../../Edits/Header.vue";
import Advanced from "./Advanced.vue";
import CustomNumberOfLesson from './CustomNumberOfLesson.vue';
import Pro from "./Pro.vue";
import Starter from "./Starter.vue";
export default {
    props: ["id"],
    data() {
      return {
      }
    },
    components: { Header, Starter, Pro, Advanced, CustomNumberOfLesson },
    mounted() {
    }
};
</script>

<style></style>
