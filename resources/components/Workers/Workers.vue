<template>
    <div>
        <div class="container">
            <div id="workers">
                <div class="item">
                    <img src="images/green.jpg" alt="Owl Image" />
                </div>
                <div class="item">
                    <img src="images/green.jpg" alt="Owl Image" />
                </div>
                <div class="item">
                    <img src="images/green.jpg" alt="Owl Image" />
                </div>
                <div class="item">
                    <img src="images/green.jpg" alt="Owl Image" />
                </div>
                <div class="item">
                    <img src="images/green.jpg" alt="Owl Image" />
                </div>
               
            </div>
        </div>
    </div>
</template>
<script>
import $ from "jquery";
$(document).ready(function() {
 
  $("#workers").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
  });
 
});
export default {
    name: 'Workers',
}

</script>

<style scoped>
#workers .item{
  margin: 3px;
}
#workers .item img{
  display: block;
  width: 100%;
  height: auto;
}
</style>
