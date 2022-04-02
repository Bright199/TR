<template>
    <div>
        <h5>Price range</h5>
        <br />
        <br />
        <Slider
            v-model="price"
            class="slider-blue"
            :format="format"
            @update="PriceRange"
        />
    </div>
</template>

<script>
import Slider from "@vueform/slider";
import axios from "axios";
export default {
    name: "ByPrice",
    components: {
        Slider,
    },
    data() {
        return {
            price: [1, 40],
            format: {
                prefix: "$",
            },
        };
    },
    methods: {
        PriceRange() {
            this.$store.dispatch({
                type: "TeachersByPrice",
                minPrice: this.price[0],
                maxPrice: this.price[1],
            });
        },
    },
};
</script>
<style src="@vueform/slider/themes/default.css"></style>
<style>
.slider-blue {
    --slider-connect-bg: #029e02;
    --slider-tooltip-bg: #029e02;
    --slider-handle-ring-color: #029e0230;
}
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 10px;
    border-radius: 20px;
    background: #ececec;
    outline: none;
    opacity: 0.8;
    -webkit-transition: 0.2s;
    transition: opacity 0.2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: #029e02;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: #029e02;
    cursor: pointer;
}
</style>
