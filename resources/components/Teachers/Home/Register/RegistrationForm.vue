<template>
  <div>
      <div class="container-jumbotron">
        <RegisterNav/>
      </div>
      <div class="container-jumbotron  mt-2">
          <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2"></div>
              <div class="col-md-8 col-sm-8 col-lg-8 p-0 bg-white rounded-2">
                 <About/>
                <!-- <Availability/>
                <Description/>
                <Qualification/>
                <Video/> -->
              </div>
              <div class="col-md-2 col-sm-2 col-lg-2"></div>
          </div>
      </div>
  </div>
</template>

<script>
import About from './FromComponents/About.vue'
import Availability from './FromComponents/Availability.vue'
import Description from './FromComponents/Description.vue'
import Qualification from './FromComponents/Qualification.vue'
import Video from './FromComponents/Video.vue'
import RegisterNav from './RegisterNav.vue'
export default {
  components: { RegisterNav, About, Availability, Description, Qualification, Video },
    name: 'Registration Form',
    data() {
        return {
            
        }
    },
    mounted() {

    },
    methods: {

    },
}
</script>

<style>

</style>