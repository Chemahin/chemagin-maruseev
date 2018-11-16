<template>
    <div class="portfolio-main">
      <h2>Portfolio</h2>


      <!-- swiper -->
      <div class="slider-wrap-main">
        <swiper :options="swiperOption" class="slider-swiper-main">
          <swiper-slide v-for="(image,index) in images" :key="Math.random()+index">
            <div class="carousel-portfolio">
              <img :src="image" alt="item">
            </div>
          </swiper-slide>
        </swiper>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
      </div>



      <!--<Carousel class="catousel-pos">-->
        <!--<div class="carousel-portfolio">-->
          <!--<img :src="images[0]" alt="item">-->
        <!--</div>-->
        <!--<div class="carousel-portfolio">-->
          <!--<img :src="images[1]" alt="item">-->
        <!--</div>-->
        <!--<div class="carousel-portfolio">-->
          <!--<img :src="images[2]" alt="item">-->
        <!--</div>-->
        <!--<div class="carousel-portfolio">-->
          <!--<img :src="images[3]" alt="item">-->
        <!--</div>-->
        <!--<div class="carousel-portfolio">-->
          <!--<img :src="images[4]" alt="item">-->
        <!--</div>-->
      <!--</Carousel>-->
    </div>
</template>

<script>
  import Button from '../Button';
  import { swiper, swiperSlide } from 'vue-awesome-swiper'

    export default {
      data() {
        return {
          swiperOption: {
            slidesPerView: 3,
            loop: true,
            setWrapperSize: true,
            spaceBetween: 0,
            breakpoints: {
              768: {
                slidesPerView: 1,
                spaceBetween: 10
              },
              1107: {
                slidesPerView: 2,
                spaceBetween: 10
              },
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev'
            }
          },
          images: [
            require('../../assets/profile/portfolio_images1.png'),
            require('../../assets/profile/portfolio_images2.png'),
            require('../../assets/profile/portfolio_images3.png'),
            require('../../assets/profile/portfolio_images1.png'),
            require('../../assets/profile/portfolio_images3.png'),
            require('../../assets/profile/portfolio_images2.png'),
            require('../../assets/profile/portfolio_images3.png'),
          ],
        }
      },
      components: {
       Button
      },
    }
</script>

<style scoped lang="scss">
  .slider-wrap-main {
    width: 100%;
    position: relative;
  }
  .slider-swiper-main {
    width: 81%;
  }
  .swiper-slide {
    display: flex;
    justify-content: center;
  }
  .swiper-button-prev {
    width: 45px;
    height: 85px;
    left: 80px;
    background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;

  }
  .swiper-button-next {
    width: 45px;
    height: 85px;
    right: 80px;
    background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;

  }
  h2 {
    font-family: GolanoSemi;
    color: #00c8d7;
    font-size: 50px;
    font-weight: 400;
    line-height: 35px;
    padding-left: 11%;
  }
  .portfolio-main {
    margin-top: 4%;
    width: 100%
  }
  .carousel-portfolio {
    margin-top: 10%;
    img {
      width: 95%;
    }
  }

  .slick-slider {
    display: flex;
    align-items: center;
    margin-left: -4%;

  }
  @media screen and (max-width: 1400px){
    .swiper-button-prev {
      background-size: contain;
      width: 35px;
      height: 65px;
      left: 30px;
    }
    .swiper-button-next {
      background-size: contain;
      width: 35px;
      height: 65px;
      right: 30px;
    }
  }
  @media screen and (max-width: 767px){
    .carousel-portfolio img {
      width: 100%;
    }
    h2 {
      font-size: 2rem;
    }
  }
  @media screen and (max-width: 720px){
    h2 {
      padding-left: 9%;
    }
    .slick-slider {
      margin-left: 0;
    }
    .portfolio-main {
      margin-top: 10%;
      padding-left: 0;
      width: 100%;
    }
  }
  @media screen and (max-width: 625px){
    .swiper-button-prev {
      left: 0;
    }
    .swiper-button-next {
      right: 0;
    }
  }

  @media screen and (max-width: 520px){
    .portfolio-main {
      width: 100%;
      padding: 0;
      h2{
        margin: 10% 0;
      }
    }
    .portfolio-items {
      display: flex;
      width: 100%;
      flex-direction: column;
    }
    .portfolio-item {
      width: 100%;
      margin-bottom: 5%;
      img {
        width: 100%;
      }
    }
    .btnCustom {
      display: flex;
      justify-content: center;
      flex-direction: column;
      width: 100%;
      button {
        width: 90%;
        font-size: 1.1rem;
        margin: 3% auto;
      }
    }
  }
  @media screen and (max-width: 440px){
    .btnCustom button{
      font-size: 0.7rem;
    }
  }
  @media screen and (max-width: 414px){
    .slider-swiper-main {
      width: 100%;
    }
  }
  @media screen and (max-width: 320px){
    .portfolio-main {
      padding: 0;
      width: 100%;
    }
    .portfolio-item {
      width: 96%;
    }
    .btnCustom button {
      width: 96%;
      font-size: 13px;
      margin-bottom: 5%;
      margin-left: 0;
      padding: 5% 0;
    }
  }
</style>
