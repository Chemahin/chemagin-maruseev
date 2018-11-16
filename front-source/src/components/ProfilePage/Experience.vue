<template>
    <div class="experience-main">
      <div class="experience-items">
        <h2>Werkervaring</h2>
        <div class="shout-out-items">
          <div class="shout-item">
            <div class="shout-item-img" @click.self="onClick(index)" v-for="(index) in list" :class="{active: index === selectedIndex}">
            </div>
          </div>
          <div class="shout-item-content">
            <div class="content-title">
              <span>{{ contettCard[selectedIndex-1].shoutOut }}</span>
              <p>{{ contettCard[selectedIndex-1].date }}</p>
            </div>
            <hr>
            <p class="content">{{ contettCard[selectedIndex-1].text }}</p>
          </div>
        </div>
      </div>
      <div class="experience-video">
        <h2>Video</h2>
        <div class="video-item"></div>
      </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          selected: '',
          selectedIndex: 1,
          list: 5,
          contettCard: [
            {
              shoutOut: 'Shout Out_1',
              date: 'Jan 2017 - heden',
              text: '2017 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com.'

            },
            {
              shoutOut: 'Shout Out_2',
              date: 'Jan 2018 - heden',
              text: '2018Lorem ipsum doloritmet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com.'

            },
            {
              shoutOut: 'Shout Out_3',
              date: 'Jan 2019 - heden',
              text: '2019Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com.'

            },
            {
              shoutOut: 'Shout Out_4',
              date: 'Jan 2020 - heden',
              text: '2020 Lorem ipsum dolor sit aet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com.'

            },
            {
              shoutOut: 'Shout Out_5',
              date: 'Jan 2021 - heden',
              text: '2021Lorem ipsum dolor sit et, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com.'

            },

          ]
        }
      },
      methods: {
        onClick(index) {
          this.selectedIndex = index;
        },
      }
    }
</script>

<style scoped lang="scss">
  .experience-main {
    display: flex;
    padding-left: 9%;
    width: 100%;
  }
  h2 {
    color: #00c8d7;
    font-family: GolanoSemi;
    font-size: 50px;
    font-weight: 400;
    line-height: 35px;
  }
  p {
    color: #646464;
    font-family: GolanoRegular;
    font-size: 25px;
    font-weight: 400;
    line-height: 40px;
  }
  .experience-items {
    margin-top: 4%;
    margin-left: 2%;
    width: 60%
  }
  .experience-video {
    margin-top: 4%;
    margin-left: 2%;
  }
  .video-item {
    width: 485px;
    height: 411px;
    background-color: #ebebeb;
    margin-top: 9.5%;
  }
  .shout-out-items {
    margin-top: 4%;
  }
  .shout-item {
    display: flex;
    img {
      margin-right: 1rem;
    }
  }
  .shout-item-img {
    position: relative;
    width: 104px;
    height: 95px;
    background: url("../../assets/shout.png") no-repeat;
  }
  .shout-item-img:after {
    display: inline-block;
    position: absolute;
    top: 4.7rem;
    left: 2.1rem;
    font-size: 35px;
    transform: scale(2, -1);
    color: #d7d7d7;
  }
  .active:after {
    content: "^";
  }
  .shout-item-content {
    border: 2px solid #d7d7d7;
    background-color: #ffffff;
    padding: 3%;
    padding-bottom: 1%;
    margin-top: 5%;

  }
  .content-title {
    display: flex;
    justify-content: space-between;
    span {
      color: #646464;
      font-family: GolanoSemi;
      font-size: 30px;
      font-weight: 400;
      line-height: 40px;
    }
    p {
      font-size: 30px;

    }
  }
  hr {
    height: 2px;
    background-color: #d7d7d7;
    margin-top: 1%;
  }
  .content {
    margin-top: 2.5%;
  }
  @media screen and (max-width: 1200px){
    .experience-main {
      flex-direction: column;
    }
    .experience-items {
      width: 90%;
    }
    .video-item {
      width: 92%;
      margin-top: 5%;
    }
  }
  @media screen and (max-width: 767px){
    h2 {
      font-size: 2rem;
    }
    p {
      font-size: 1.5rem;
    }
    .content-title {
      span {
        font-size: 1.8rem;
      }
      p {
        font-size: 1.8rem;
      }
    }
    .experience-video {
      display: none;
    }
  }
  @media screen and (max-width: 720px){
    .experience-items {
      margin: 0;
    }
    .shout-item {
      display: flex;
      justify-content: center;
      margin-bottom: 10%;
    }
    .content-title {
      p {
        font-size: 1.5rem;
      }
      span {
        font-size: 1.5rem;
      }
    }
    .content {
      font-size: 1.5rem;
      line-height: 30px;
    }
  }
  @media screen and (max-width: 620px){
    .shout-item-img {
      width: 18%;
      height: 75px;
      background-position: center;
      background-size: contain;
    }
    .shout-item-img:after {
      top: 4.7rem;
      left: 2.1rem;
    }
    .experience-video {
      margin: 0;
      margin-top: 10%;
    }
    .video-item {
      width: 90%;
    }
  }
  @media screen and (max-width: 520px){
    .experience-main {
      padding: 0;
      width: 100%;
    }
    .experience-items {
      width: 100%;
    }
    .shout-item-content {
      border: 0;
    }
    .shout-item-img{
      width: 17%;
      height: 62px;
    }
    .shout-item-img:after {
      top: 3.7rem;
      left: 2.1rem;
      font-size: 20px;
    }
    .content-title {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .video-item {
      width: 100%;
    }
    h2 {
      padding-left: 9%;
    }
  }
  @media screen and (max-width: 440px){
    .shout-item-img:after {
      left: 41%;
    }
  }
  @media screen and (max-width: 320px){
    .content {
      text-align: center;
    }
  }

</style>

