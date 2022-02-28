<template>
    <div>
        <img :src="userImagPreview" alt="" width="150" >
        <!-- <Cropper
            class="cropper"
            :src="img"
            :stencil-props="{
                aspectRatio: 12 / 12,
            }"
            @change="change"
        /> -->
        <label for="imageIcon" class="btn btn-light"><i class="fa-solid fa-upload"></i>&nbsp; Upload Image</label>
        <input type="file" name="userprofile" id="imageIcon" @change="uploadUserImage" style="display:none" />
    </div>
</template>
<script>
// import { Cropper } from "vue-advanced-cropper";
// import "vue-advanced-cropper/dist/style.css";
export default {
    name: "ImageCrop",
    components: {
        // Cropper,
    },
    data() {
        return {
            img: "",
            userImag: "",
            userImagPreview: "",
        };
    },
    methods: {
        change({ coordinates, canvas }) {
            // console.log(canvas);
            this.userImagPreview = canvas.toDataURL();
            this.$store.commit('profileImage',canvas.toDataURL())
        },
        uploadUserImage(e) {
            this.userImag = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.userImag);
            reader.onload = (e) => {
                this.userImagPreview = e.target.result;
            };
            // console.log(this.userImag)
        },
    },
};
</script>
<style scoped>
.cropper {
    height: 250px;
    width: 250px;
    background-image: url("/images/avatar.png");
    background-color: #cccccc;
    height: 250px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}
</style>
