<template>
    <div class="wrapp">

      <div class="left-part">
        <div class="up">
          <div class="up-left">
            <img v-lazy="selecteSpecialist.user_image || mysrc1 " alt="photo">
          </div>
          <div class="up-right">
            <div class="wrap-item">
              <div class="name-first">

                <p>{{ selecteSpecialist.firstname }} {{ selecteSpecialist.lastname }}</p>
                <span>In-house</span>
                <span>Remote</span>
              </div>
              <div class="name-last">
                <p><span>€30,- </span> per uur</p>
              </div>
            </div>
            <div class="specialty">
              <p>{{ selecteSpecialist.role_name }}</p>
              <div class="rating-stars">
                <img v-for="n in calcRating(selecteSpecialist.rating) || 1" :key="n + Math.random()" :src="mysrc2" alt="star">
              </div>
            </div>
            <hr>
            <div class="wrap-item availability">
              <div class="availability-first">
                <p><span>Beschikbaar</span> 30 uur p/w</p>
                <div class="point-items">
                  <div class="point">MA</div>
                  <div class="point">DI</div>
                  <div class="point">WO</div></div>

              </div>
                <div class="availability-last">
                  <p> <span>Rating</span>  {{ selecteSpecialist.rating }}/10</p>
                </div>
            </div>
            <div class="btnCustom" @click="onOpenPopUp">

                <Button btnText="VRAAG DEZE SPECIALIST AAN"
                        btnClass="btnOrangeNav">
                </Button>
            </div>
          </div>
        </div>
        <hr>
        <div class="skills">
          <h2>Vaardigheden</h2>
          <div class="skills-items">
            <div class="skills-item" v-for="(list) in skillList" v-bind:key="list + Math.random()">{{list}}</div>
          </div>
        </div>
      </div>

      <div class="right-part">
        <h2>Diploma’s</h2>
        <div class="mbo-items">
          <div class="mbo-item">MBO4</div>
          <div class="mbo-item">MBO3</div>
          <div class="mbo-item">VMBO</div>
        </div>
        <hr>
        <h2>Interne opleidingen</h2>
        <hr class="hr-down">
        <p class="rjb"><span>Rijbewijs</span> Ja</p>

      </div>
    </div>
</template>

<script>
  import Button from '../Button';
  import { mapGetters } from 'vuex';
    export default {
        components: {
          Button
        },
      data() {
          return {
              mysrc1:require(`../../assets/person.png`),
              mysrc2:require(`../../assets/icons/star-active.png`),
              skillList: [
                'Photoshop',
                'Illustrator',
                'Sales',
                'E-commerce',
                'Photoshop',
                'Photoshop',
                'Illustrator',
                'Sales',
                'E-commerce',
                'Photoshop',
                'Photoshop',
                'Illustrator',
                'Sales',
                'E-commerce',
                'Photoshop',

              ]
          }
      },
      methods: {
        calcRating(num){
          let quantity = 1;
          (num == 0 || num == 1) ? quantity : quantity = Math.floor(num/2);
          return quantity;
        },
        onOpenPopUp(){
          this.$store.dispatch('specialistPopUp/statePopUpAct', true);
          this.$store.dispatch('specialistList/selecteSpecialist', this.specialistId);
          const elBody = document.getElementsByTagName('body')[0];
          elBody.style.overflow= 'hidden';
        },
      },
      computed: {
        ...mapGetters({
          selecteSpecialist: 'specialistList/getSelecteSpecialist',
        }),
      },

    }
</script>

<style scoped lang="scss">
  p {
    font-family: GolanoRegular;
  }
  .point-items {
    display: flex;
  }
  .wrapp {
    padding-left: 9%;
    display: flex;
    width: 95%;
    justify-content: space-between;
    margin-top: 5%;
  }
  .left-part {
    width: 64%;
    border: 2px solid #d7d7d7;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    padding-bottom: 2%;
  }
  .right-part {
    width: 34%;
    border: 2px solid #d7d7d7;
    background-color: #ffffff;
  }
  .up {
    width: 100%;
    display: flex;
  }
  .up-left {
    width: 29%;
    text-align: center;
    padding-top: 3%;
    img {
      width: 85%;
      border-radius: 50%;
    }
  }
  .up-right {
    width: 70%;
    hr {
      border: 1px solid #d7d7d7;
      background-color: #ffffff;
      width: 97%;
      margin-top: 4%;
      margin-left: -1%;
    }
  }
  .wrap-item {
    display: flex;
    justify-content: space-between;
  }

  .name-first {
    display: flex;
    align-items: flex-start;
    width: 70%;
    margin-top: 10%;
    p {
      font-family: GolanoSemi;
      font-size: 2.2vw;
      font-weight: 600;
      margin-bottom: 0;
      width: 50%;
      line-height: 35px;
    }
    span {
      border-radius: 4px;
      background-color: #ff8400;
      margin-left: 3%;
      color: white;
      font-size: 20px;
      padding: 2px 10px 0 2%;
      width: 25%;
    }
  }
  .name-last {
    width: 30%;
    p{
      font-size: 25px;
      font-weight: 400;
      line-height: 35px;
      color: #646464;
      margin-top: 37%;
      margin-left: 17%;
      margin-bottom: 0;
      span {
        color: #00c7d6;
        font-family: GolanoSemi;
        font-weight: 600;
      }
    }
  }

  .specialty{
    display: flex;
    justify-content: space-between;
    width: 100%;
    p{
      font-size: 27px;
      font-weight: 400;
      line-height: 20px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
    }
  }
  .rating-stars {
    width: 23%;
    img {
      width: 15%;
    }
  }

  .availability {
    margin-top: 6%;
  }

  .availability-first {
    display: flex;
    width: 70%;
    p {
      font-size: 24px;
      font-weight: 400;
      line-height: 35px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
      margin-right: 10%;
    }
    span {
      font-family: GolanoSemi;
    }
  }
  .point {
    width: 40px;
    height: 35px;
    background-color: #2ad0e1;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    margin-right: 2%;
    font-size: 15px;
  }
  .availability-last {
    width: 30%;
    padding-left: 5%;
    p {
      font-size: 24px;
      font-weight: 400;
      line-height: 35px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
      margin-right: 10%;
    }
    span {
      font-family: GolanoSemi;
    }
  }

  .btnCustom{
    margin: 4% 0;
    button{
      width: 451px;
      font-size: 1.24vw;
      padding: 1.5% 0;
    }
  }

  hr {
    height: 2px;
    background-color: #d7d7d7;
    width: 93%;
    margin-top: 3%;
  }

  .skills {
    margin-top: 2%;
    margin-left: 3%;
    h2 {
      color: #646464;
      font-family: GolanoSemi;
      font-size: 25px;
      font-weight: 400;
      line-height: 35px;
    }
  }
  .skills-items {
    width: 97%;
    margin-top: 2%;
    display: flex;
    flex-wrap: wrap;

  }
  .skills-item {
    width: 19%;
    border-radius: 5px;
    border: 1px solid #c8c8c8;
    margin-right: 1%;
    margin-bottom: 1.5%;
    padding: 1.5% 0;
    text-align: center;
    color: #484755;
    font-family: GolanoRegular;
    font-size: 17px;
  }

  .right-part {
    padding: 2%;
    h2 {
      color: #646464;
      font-family: GolanoSemi;
      font-size: 25px;
      font-weight: 400;
      line-height: 35px;
    }
    p {
      font-size: 25px;
      font-weight: 400;
      line-height: 35px;
      color: #646464;
      margin-top: 9%;
      margin-left: -1%;
      margin-bottom: 0;
      padding-left: 1%;
    }
    span {
      font-family: GolanoSemi;
      margin-right: 10%;
    }
  }
  .mbo-items {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    margin-top: 4%;
    margin-bottom: 35%;
  }
  .hr-down {
    margin-top: 27%;
  }
  .mbo-item {
    margin-right: 2%;
    padding: 2%;
    border-radius: 5px;
    border: 1px solid #d7d7d7;
    color: #484755;
    font-family: GolanoRegular;
    font-size: 25px;
    font-weight: 400;
    line-height: 25px;
    text-transform: uppercase;
    text-align: center;
  }
  @media screen and (max-width: 1698px){
    .name-last p {
      margin-left: 7%;
    }
  }
  @media screen and (max-width: 1520px){
    .name-last p {
      margin-left: 1%;
    }
    .btnCustom button {
      width: 80%;
    }
  }
  @media screen and (max-width: 1425px){
    .up *{
      font-size: 1.2rem;
    }
    .up-left {
      img {
        width: 80%;
      }
    }
    .name-last p {
      font-size: 1.4rem;
    }
    .name-first p {
      font-size: 1.7rem;
      width: 27%;
    }
    .name-first span {
      font-size: 1.1rem;
      width: 27%;
    }
    .availability-first p {
      margin-right: 1%;
    }
    .availability-last {
      padding: 0;
    }
    .up-right hr {
      margin-left: 0;
      width: 80%;
    }
    .availability-first p {
      font-size: 1.3rem;
    }
  }
  @media screen and (max-width: 1200px){
    .up * {
      font-size: 1.5rem;
    }
    .name-first p {
      width: 100%;
    }
    .point {
      width: 45px;
      height: 45px;
    }
    .wrapp {
      flex-direction: column;
    }
    .left-part {
      width: 100%;
      border: none;
      border-bottom: 2px solid #d7d7d7;
    }
    .right-part {
      width: 100%;
      border: none;
      padding: 0;
      margin-top: 4%;
      margin-bottom: 5%;
    }
    .mbo-items {
      margin-bottom: 5%;
    }
    .hr-down {
      margin-top: 15%;
    }
    hr {
      width: 100%;
      height: 1px;
    }
    .mbo-item {
      width: 18%;
      padding: 9% 0;
    }
    .name-first span {
      display: none;
    }
    .name-last {
      display: none;
    }
    .btnCustom {
      display: none;
    }
    .up-right hr {
      width: 96%;
    }
    .specialty {
      width: 100%;
      display: flex;
      align-items: center;
      p {
        width: 60%;
      }
      .rating-stars {
        width: 30%;
      }
    }
  }
    @media screen and (max-width: 720px){
    hr {
      width: 100%;
    }
    .up {
      flex-direction: column;
      justify-content: center;
    }
    .up-left {
      width: 100%;
      img {
        width: 40%;
      }
    }
    .up-right {
      width: 100%;
      hr {
        width: 100%;
      }
    }
    .wrap-item {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .availability-first {
      width: 100%;
      display: flex;
      flex-direction: column;
      text-align: center;
    }
    .point-items {
      justify-content: center;
    }
    .availability-last {
      width: 100%;
      text-align: center;
    }
    .skills-items {
      width: 100%;
    }
    .skills-item {
      width: 49%;
    }
      .name-first {
        width: 100%;
        text-align: center;
      }
    .specialty p {
      width: 50%;
    }
    .specialty .rating-stars {
      width: 45%;
    }
    .rating-stars {
      text-align: right;
      img {
        width: 11%;
      }
    }
    .mbo-item {
      font-size: 20px;
    }
    .rjb {
      display: none;
    }
    h2 {
      text-align: center;
    }
  }
  @media screen and (max-width: 450px){
    .mbo-items {
      justify-content: center;
      flex-wrap: wrap;
    }
    .mbo-item {
      width: 23%;
      font-size: 17px;
    }
    .specialty {
      flex-direction: column;
      p {
        width: 100%;
        text-align: center;
      }
      .rating-stars {
        width: 100%;
        text-align: center;
      }
    }
  }
  @media screen and (max-width: 320px){
    .wrapp {
      padding: 0;
      width: 100%;
    }
    .specialty {
      display: flex;
      flex-direction: column;
      text-align: center;
      p {
        width: 100%;
      }
      .rating-stars {
        width: 100%;
      }
    }
    .name-first {
      width: 100%;
      justify-content: center;
    }
    .availability-first p {
      margin: 2% 0;
    }
    .skills {
      margin-left: 0;
    }
  }
</style>
