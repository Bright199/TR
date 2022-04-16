<template>
  <div>
      <div class="container-jumbotron">
          <Header/>
      </div>
      <h3>Packages</h3>
      <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 bg-white">
              <div class="row">
                  <div class="col-md-4 shadow-sm ">
                      <h4>Lower price</h4>
                      <p>Sub total: $45</p>
                        <p>You will save</p>
                  </div>
                  <div class="col-md-4 shadow-sm">
                      <h4>Middle package</h4>
                  </div>
                  <div class="col-md-4 shadow-sm">
                      <h4>Higher package</h4>
                  </div>
                  <div class="container">
                      <a href="#" > Buy a custom number of hours</a>
                  </div>
              </div>
          </div>
          <div class="col-md-2"></div>
      </div>
  </div>
</template>

<script>
import Header from '../../Edits/Header.vue'
export default {
  components: { Header },
name:'LessonPackages',

}
</script>

<style>

</style>