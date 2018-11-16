<template>
  <b-container fluid class="footer-wrapp">
    <b-row>
      <b-col md="3" cols="6" class="no-padding">
        <a href="https://www.facebook.com/CauseffectNL/" class="social-item">
          <i class="fab fa-facebook-square"></i>
        </a>

      </b-col>
      <b-col md="3" cols="6" class="no-padding">
        <a href="https://www.instagram.com/causeffectnl/?hl=nl" class="social-item">
          <i class="fab fa-instagram"></i>
        </a>
      </b-col>
      <b-col md="3" cols="6" class="no-padding">
        <a href="https://twitter.com/CauseffectNL" class="social-item">
          <i class="fab fa-twitter"></i>
        </a>
      </b-col>
      <b-col md="3" cols="6" class="no-padding">
        <a href="https://www.linkedin.com/company/causeffect-nl/" class="social-item">
          <i class="fab fa-linkedin-in"></i>
        </a>

      </b-col>
    </b-row>
  </b-container>
</template>
<script>

</script>
<style scoped>
  .no-padding {
    padding: 0;
  }
  .social-item {
    text-decoration: none;
    color: #00c7d6;
    text-align: center;
    font-size: 4vw;
    padding-top: 3.3%;
    padding-left: 2%;
    padding-bottom: 3.3%;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 160px;

  }
  .social-item:hover {
    color: white;
    background: black;
  }
  @media screen  and (max-width: 767px){
    .social-item {
      font-size: 10vw;
      padding-top: 4.3%;
      padding-bottom: 4.3%;
    }

  }
  @media screen  and (max-width: 440px){
    .social-item {
      height: 80px;
    }

  }
  @media screen  and (max-width: 320px){
    .footer-wrapp {
      padding: 0;
    }
    .social-item {
      height: 60px;
    }
    .row {
      margin: 0;
    }
  }

</style>
