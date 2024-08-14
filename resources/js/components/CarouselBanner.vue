<template>
  <Carousel :autoplay="2000">
    <Slide v-for="slide in CarouselItens" :key="slide">
      <a class="carousel__item" :href="slide.link">
        <img class="item-image" v-bind:src="'/storage/'+slide.image" alt="">
        <div class="infos">
          <p class="item-text-above">{{ slide['text above'] }}</p>
          <h2 class="item-main-text">{{ slide['main text'] }}</h2>
          <button class="item-button">{{ slide['button text'] }}</button>
        </div>
      </a>
    </Slide>

    
  </Carousel>
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'
import axios from "axios";
export default defineComponent({
  name: 'Basic',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data(){
    return {
      CarouselItens: null
    }
  },
  methods:{
    getCarouselItens: async function(){
      const _this = this;

      await axios({
          method: 'get',
          url: '/api/carousel/get'
      }).then(function(response){
          _this.CarouselItens = response.data
      })
  }
  },
  async created(){
    await this.getCarouselItens()
  }
})
</script>
<style scoped>
.item-text-above{
  font-style: normal;
}
.item-main-text{
  margin-top: 0.3em;
  font-size: 75px;
  margin-bottom: 0.3em;
}
.item-button{
  background-color: #fafafa;
  color: #1A1A1A;
  font-size: medium;
  font-weight: 700  ;
  width: fit-content;
  padding-left: 1.5em;
  padding-right: 1.5em;
  height: 2em;
  border-color: transparent;
  border-radius: 30px;
  cursor:pointer;
}
.item-button:hover{
  opacity: 60%;
}
</style>
<style scoped>
.carousel__item {
  position: relative;
  min-height: 200px;
  width: 100%;
  color: var(--vc-clr-white);
  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.infos {
  position: absolute;
}

.item-image {
  height: 30rem;
  width: 100%;
}

.carousel__icon {
  color: #fafafa
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
}
</style>
<style>
.carousel__track {
  margin: 0px;
}
</style>