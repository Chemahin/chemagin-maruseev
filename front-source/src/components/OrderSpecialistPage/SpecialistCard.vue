<template>
    <div>
      <div class="order-left">
        <div class="left-up">
          <div class="up-left">
            <img v-lazy="mysrc2 || selecteSpecialist.user_image" alt="photo">
          </div>
          <div class="up-right">
            <div class="wrap-item">
              <div class="name-first">
                <p> {{ selecteSpecialist.firstname }} {{ selecteSpecialist.lastname }}</p>
              </div>
              <div class="name-last">
                <p><span>€30,- </span> per uur</p>
              </div>
            </div>
            <div class="specialty">
              <p> {{ selecteSpecialist.role_name }}</p>
              <div class="rating-stars">
                <img v-for="n in calcRating(selecteSpecialist.rating) || 1" :key="n + Math.random()" :src="mysrc3" alt="star">

              </div>
            </div>
            <hr>
            <div class="wrap-item availability">
              <div class="availability-first">
                <p><span>Beschikbaar</span> 30 uur p/w</p>
              </div>
              <div class="availability-last">
                <p> <span>Rating</span>  {{ selecteSpecialist.rating }}/10 </p>
              </div>
            </div>
            <div class="point-items">
              <div class="point">MA</div>
              <div class="point">DI</div>
              <div class="point">WO</div>
            </div>
          </div>
        </div>
        <hr>
      </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex';
    export default {
        data(){
            return {
                mysrc1:require(`../../assets/icons/close.png`),
                mysrc2:require(`../../assets/person.png`),
                mysrc3:require(`../../assets/icons/star-active.png`),
            }
        },
      methods: {
        calcRating(num){
          let quantity = 1;
          (num == 0 || num == 1) ? quantity : quantity = Math.floor(num/2);
          return quantity;
        }
      },
      computed: {
        ...mapGetters({
          selecteSpecialist: 'specialistList/getSelecteSpecialist',
        }),
      },

    }
</script>

<style scoped lang="scss">
  .order-left {
    width: 100%;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    padding-bottom: 2%;
    position: relative;
  }
  .left-up {
    width: 100%;
    display: flex;
  }
  .up-left {
    width: 30%;
    padding-top: 3%;
    text-align: center;
    img {
      width: 85%;
      border-radius: 50%;
    }
  }
  .up-right {
    width: 67%;
    hr {
      height: 2px;
      background-color: #d7d7d7;
      width: 97%;
      margin-top: 4%;
      margin-left: -1%;
    }
  }
  .wrap-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
  }
  .name-first {
    display: flex;
    align-items: flex-start;
    width: 50%;
    margin-top: 10%;
    p {
      font-family: GolanoSemi;
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 0;
      line-height: 35px;
    }
  }
  .name-last {
    width: 45%;
    display: flex;
    justify-content: flex-end;
    p{
      font-size: 1.5rem;
      line-height: 35px;
      color: #646464;
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
      font-size: 1.5rem;
      line-height: 20px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
    }
  }
  .rating-stars {
    width: 34%;
    img {
      width: 15%;
    }
  }
  .availability {
    margin-top: 5%;
  }

  .availability-first {
    display: flex;
    width: 70%;
    p {
      font-size: 1.5rem;
      line-height: 35px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
      width: 100%;
    }
    span {
      font-family: GolanoSemi;
      margin-right: 5%;

    }
  }
  .point {
    width: 60px;
    height: 60px;
    background-color: #2ad0e1;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    margin-right: 2%;
    font-size: 21px;
    line-height: 41.85px;
    text-transform: uppercase;
  }
  .availability-last {
    width: 30%;
    padding-left: 5%;

    p {
      font-size: 24px;
      line-height: 35px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
      margin-left: 10%;
    }
    span {
      font-family: GolanoSemi;
    }
  }
  .point-items {
    display: flex;
    justify-content: center;
    width: 83%;
    margin-top: 2%;
  }
  hr {
    height: 2px;
    background-color: #d7d7d7;
    width: 93%;
    margin-top: 3%;
  }

  @media screen  and (max-width: 1410px){
    .left-up {
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
      padding: 2% 5%;
      hr {
        width: 100%;
        margin-left: 0;
      }
    }
    .point-items {
      width: 100%;
    }
  }
  @media screen  and (max-width: 800px){
    .name-first p {
      font-size: 2rem;
    }
    .availability-first {
      width: 60%;
    }
    .availability-last {
      width: 35%;
      padding: 0;
      display: flex;
      justify-content: flex-end;
    }
  }
  @media screen  and (max-width: 680px){
    .wrap-item, .specialty {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 5%;
    }
    .name-first, .name-last {
      justify-content: center;
      width: 100%;
    }
    .availability-first {
      width: 100%;
      text-align: center;
    }
    .availability-last {
      width: 100%;
      justify-content: center;
      p {
        margin-left: 0;
      }
    }
  }
  @media screen  and (max-width: 530px){
    .name-last {
      display: none;
    }
    .name-first {
      width: 100%;
      justify-content: center;
    }
    .specialty {
      flex-direction: column;
      text-align: center;
    }
    .rating-stars {
      width: 100%;
      img {
        width: 10%;
      }
    }
    .availability {
      flex-direction: column;
      text-align: center;
    }
    .availability-first {
      width: 100%;
      p {
        font-size: 1.3rem;
      }
    }
    .availability-last {
      width: 100%;
      justify-content: center;
      p {
        margin: 0;
        font-size: 1.3rem;
      }
    }
    .up-left img {
      width: 50%;
    }
  }
  @media screen  and (max-width: 390px){
    .availability-first {
      p {
        font-size: 1.1rem;
      }
      span {
        margin-right: 1%;
      }
    }
    .availability-last {
      p {
        font-size: 1.1rem;
      }
    }
    .point-items {
      justify-content: space-around;
    }
    .point {
      width: 45px;
      height: 45px;
      font-size: 1rem;
    }
    .rating-stars img {
      width: 12%;
    }
  }
</style>
