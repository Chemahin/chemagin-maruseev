<template>
    <div class="wrapp">
      <div class="price-items">
        <div class="price-item"  v-for="(price, index) in priceList" :key="index + Math.random()">
          <img @click.self="onClickPrice(index)" :src=" index === selectedPriceIndex ? price.imgActive : price.img" alt="image" >
          <h2>{{ price.title }}</h2>
          <span> &#8364; {{ price.text }}</span>
        </div>
      </div>
      <div class="filters">
        <div class="filter-item">
          <vue-single-select
            inputId="specialismen"
            v-model="filters.role_name"
            placeholder="Specialismen"
            :options="['All','Graphic designers','DTP’ers','Host','Copywriters','SEA specialists','SEO specialists','Social media marketeers','Camera operators','Video editors','Motion graphic designers']"
            :required="true"
            class="input-cast"
          ></vue-single-select>
        </div>
        <div class="filter-item">
          <vue-single-select
            inputId="regio"
            v-model="filters.filterSecond"
            placeholder="Regio"
            :options="['All','Regio_2','Regio_3','Regio_4']"
            :required="true"
            class="input-cast"
          ></vue-single-select>
        </div>
        <div class="filter-item">
          <vue-single-select
            inputId="werkplek"
            v-model="filters.filterThird"
            placeholder="Locatie werkplek"
            :options="['werkplek_1','werkplek_2','werkplek_3','werkplek_4']"
            :required="true"
            class="input-cast"
          ></vue-single-select>
        </div>
        <div class="filter-item">
          <vue-single-select
            inputId="last"
            v-model="filters.filterLast"
            placeholder="Locatie last"
            :options="['last_1','last_2','last_3','last_4']"
            :required="true"
            class="input-cast"
          ></vue-single-select>
        </div>
      </div>
      <b-container fluid class="anketa-items">
        <b-row>
          <b-col class="anketa-item" v-for="profile in filteredList" xl="4" sm="6" :key="profile.id + Math.random()">
            <Anketa
              :name="profile.firstname"
              :lastName="profile.lastname"
              :text="profile.role_name"
              :img="profile.user_image"
              :specialistId="profile.id"
              :stars="calcRating(profile.rating)"
              :type="'stars'">
            </Anketa>
          </b-col>
        </b-row>
        <b-row>
          <b-col class="anketa-item" v-for="profile in filteredList" :key="profile.id + Math.random()" xl="4" sm="6" cols="12">
            <AnketaDisabled
              :name="profile.firstname"
              :lastName="profile.lastname"
              :text="profile.role_name"
              :img="profile.user_image"
              :date="profile.contract_end"
              >
            </AnketaDisabled>
          </b-col>
          <b-col class="anketa-item" v-for="profile in filteredList" :key="profile.id + Math.random()" xl="4" sm="6" cols="12">
            <AnketaInConversation
              :name="profile.firstname"
              :lastName="profile.lastname"
              :text="profile.role_name"
              :img="profile.user_image"
              :stars="calcRating(profile.rating)"
              :type="'stars'">
            </AnketaInConversation>
          </b-col>
        </b-row>
      </b-container>
      <div class="slider-form">
        <!-- swiper -->
        <div class="slider-wrap-main">
          <swiper :options="swiperOptionAnceta" class="slider-swiper-main">
            <swiper-slide class="anketa-item" v-for="specialist in filteredList" :key="specialist.id + Math.random()">
              <Anketa
                :name="specialist.firstname"
                :lastName="specialist.lastname"
                :text="specialist.role_name"
                :img="specialist.user_image"
                :stars="calcRating(specialist.rating)"
                :specialistId="specialist.id"
                :type="'stars'">
              </Anketa>
            </swiper-slide>
          </swiper>
          <div class="swiper-button-prev spec-left" slot="button-prev"></div>
          <div class="swiper-button-next spec-right" slot="button-next"></div>
        </div>
      </div>
      <div class="slider-form">
        <!-- swiper -->
        <div class="slider-wrap-main">
          <swiper :options="swiperOptionAncetaDisabled" class="slider-swiper-main">
            <swiper-slide class="anketa-item" v-for="specialist in filteredList" :key="specialist.id + Math.random()">
              <AnketaDisabled
                :name="specialist.firstname"
                :lastName="specialist.lastname"
                :text="specialist.role_name"
                :img="specialist.user_image"
                :date="specialist.contract_end">
              </AnketaDisabled>
            </swiper-slide>
          </swiper>
          <div class="swiper-button-prev spec-dis-left" slot="button-prev"></div>
          <div class="swiper-button-next spec-dis-right" slot="button-next"></div>
        </div>
      </div>
      <div class="slider-form">
        <!-- swiper -->
        <div class="slider-wrap-main">
          <swiper :options="swiperOptionAncetaConversation" class="slider-swiper-main">
            <swiper-slide class="anketa-item" v-for="specialist in filteredList" :key="specialist.id + Math.random()">
              <AnketaInConversation
                :name="specialist.firstname"
                :lastName="specialist.lastname"
                :text="specialist.role_name"
                :img="specialist.user_image"
                :stars="calcRating(specialist.rating)"
                :type="'stars'">
              </AnketaInConversation>
            </swiper-slide>
          </swiper>
          <div class="swiper-button-prev spec-con-left" slot="button-prev"></div>
          <div class="swiper-button-next spec-con-right" slot="button-next"></div>
        </div>
      </div>
</div>
</template>

<script>
  import { mapGetters } from 'vuex';
import VueSingleSelect from "vue-single-select";
import Anketa from '../Anketa';
import AnketaDisabled from './AnketaDisabled';
import AnketaInConversation from './AnketaInConversation';
  import { swiper, swiperSlide } from 'vue-awesome-swiper'

export default {
  data() {
    return {
      filters: {
        role_name: '',
        filterSecond: '',
        filterThird: '',
        filterLast: '',
      },
      toRenderList: [],
      selectedPriceIndex: 0,
      swiperOptionAnceta: {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 0,
        navigation: {
          nextEl: '.spec-right',
          prevEl: '.spec-left'
        }
      },
      swiperOptionAncetaDisabled: {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 0,
        navigation: {
          nextEl: '.spec-dis-right',
          prevEl: '.spec-dis-left'
        }
      },
      swiperOptionAncetaConversation: {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 0,
        navigation: {
          nextEl: '.spec-con-right',
          prevEl: '.spec-con-left'
        }
      },
      priceList: [
        {
          imgActive: require(`../../assets/semi.png`),
          img: require(`../../assets/semi2.png`),
          title: "Semi Pro",
          text: "30 p.u",
          val: "semi",
        },
        {
          imgActive: require(`../../assets/pro.png`),
          img: require(`../../assets/pro2.png`),
          title: "Pro",
          text: "45 p.u",
          val: "pro",
        },
        {
          imgActive: require(`../../assets/expert.png`),
          img: require(`../../assets/expert2.png`),
          title: "Expert",
          text: "55 p.u",
          val: "expert",
        },
      ],
    }
  },
  methods: {
    onClickPrice(index) {
      this.selectedPriceIndex = index;
      console.log(this.priceList[index].val);
    },
    calcRating(num){
      let quantity = 1;
      (num == 0 || num == 1) ? quantity : quantity = Math.floor(num/2);
      return quantity;
    },
  },
  computed: {
    ...mapGetters({
      specialistList: 'specialistList/getAllUsers'
    }),
    filteredList() {
      return this.toRenderList = this.specialistList.filter( item => {
        for(let key in this.filters) {
          const keyValue = this.filters[key];
          if( !keyValue || !keyValue.trim() || keyValue=='All'  ) continue;
          if(item[key] !== keyValue) {
            return false;
          }
        }
        return true;
      })
    }
  },
  components: {
    VueSingleSelect,
    Anketa,
    AnketaDisabled,
    AnketaInConversation,
  },
}
</script>

<style scoped lang="scss">
  .slider-wrap-main {
    width: 100%;
    position: relative;
  }
  .slider-swiper-main {
    width: 90%;
  }
  .anketa-item {
    margin-right: 0;
  }
  .swiper-button-prev {
    width: 45px;
    height: 85px;
    left: -35px;
    top: 25%;
    background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;

  }
  .swiper-button-next {
    width: 45px;
    height: 85px;
    right: -35px;
    top: 25%;
    background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;
  }
  .slider-form {
    display: none;
  }
p {
margin: 0;
color: #646464;
font-family: GolanoRegular;
font-size: 25px;
font-weight: 400;
line-height: 30.54px;
}
.price-items {
display: flex;
justify-content: center;
width: 100%;
margin-left: 4%;
}
.price-item {
width: 160px;
text-align: center;
padding-top: 2%;
margin-right: 2% ;
cursor: pointer;

img {
  width: 90%;
  margin-bottom: 12%;
}
h2 {
  color: #646464;
  font-family: GolanoSemi;
  font-size: 29px;
  margin: 0;
}
span {
  color: #646464;
  font-family: GolanoRegular;
  font-size: 29px;
}
}
.filters, .filter-item {
display: flex;
}
.filters {
width: 100%;
margin-top: 4%;
margin-left: 2.5%;
justify-content: space-around;
}
.filter-item {
width: 32%;
div {
  width: 100%;
}
}
.input-cast {
font-family: GolanoRegular;
font-size: 20px;
font-weight: 400;
line-height: 30.54px;

}
.anketa-items {
margin-top: 4%;
margin-left: 1%;
width: 84vw;
}
.anketa-item {
margin-bottom: 4%;
}
@media screen and (max-width: 1780px) {
button{
  font-size: 0.8rem;
  padding: 3% 0 !important;
}
}
@media screen and (max-width: 1440px) {
button{
  font-size: 0.7rem;
}
}

@media screen and (max-width: 1090px){
.input-cast{
  font-size: 1rem;
}
.anketa-item {
  padding: 0;
}
}
@media screen and (max-width: 900px){
.filters {
flex-direction: column;
}
.filter-item {
  width: 100%;
}

}
@media screen and (max-width: 575px){
  .anketa-items {
    display: none;
  }
  .slider-form {
    display: block;
  }
}

@media screen and (max-width: 500px) {
.price-item {
  img {
    width: 70%;
  }
  h2 {
    font-size: 1.5rem;
  }
  span {
    font-size: 1.2rem;
  }
}
}
@media screen  and (max-width: 440px){
.anketa-item {
  padding: 0;
}
}
@media screen  and (max-width: 425px){
.filters {
  margin-left: 0;
  padding: 3%;
}
.anketa-items {
  margin-left: 0;
  width: 100%;
}
  .slider-swiper-main {
    width: 100%;
  }
  .anketa-item {
    margin-right: 0;
  }
  .swiper-button-prev {
    background-size: contain;
    width: 35px;
    top: 43%;
    height: 65px;
    left: 10px;
  }
  .swiper-button-next {
    background-size: contain;
    width: 35px;
    height: 65px;
    top: 43%;
    right: 10px;
  }
}

@media screen and (max-width: 410px) {
.price-item {
  img {
    width: 60%;
  }
  h2 {
    font-size: 1.3rem;
  }
  span {
    font-size: 1rem;
  }
}
}
@media screen and (max-width: 320px){
.price-items {
  margin-left: 0;
  margin-bottom: 10%;
}
.filter-item div {
  width: 100%;
}
.anketa-items {
  margin-left: 0;
  padding: 0;
  .anketa-item {
    padding: 0;
  }
}
}
</style>

