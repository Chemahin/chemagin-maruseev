<template>
    <button @click="logIn" type="button" :class="btnClass">
        {{btnText}}
        <img :src="mysrc1"
             alt="arrow"
             v-if="arrow==='short'"
             :style="stylesImg!==''?stylesImg:''">
        <img :src="mysrc2"
             alt="arrow"
             v-else-if="btnClass==='btnOrangeNav'"
             :style="stylesImg!==''?stylesImg:''">
        <img :src="mysrc3"
             alt="arrow"
             :style="stylesImg!==''?stylesImg:''"
             v-else>
    </button>
</template>
<script>
    export default {
        data(){
            return {
                mysrc1:require(`../assets/icons/arrow-short.png`),
                mysrc2:require(`../assets/icons/arrow-long-white.png`),
                mysrc3:require(`../assets/icons/arrow-long-orange.png`),
            }
        },
        props:{
            btnText:'',
            arrow:'',
            btnClass:'',
            stylesImg:''
        },
      methods: {
          logIn(){
            this.$emit('click-login');
          }
      }
    }
</script>
<style scoped lang="scss">
    img{
        max-width: 100%;
        margin-left: 5px;
        display: inline;
    }
    button{
        font-size: 1vw;
        font-family: GolanoSemi;
        border-radius: 10px;
        outline:none;
    }

    .btnOrangeNav{
        background: #ff8400;
        color: white;
        border: 3px solid #ff8400;
        padding: 13px;
        cursor: pointer;
    }
    .btnOrangeNav:hover {
        background: white;
        color: #ff8400;
    }
    .btnWhite{
        background: white;
        color: #ff8400;
        border: 3px solid #ff8400;
        padding: 13px;
        cursor: pointer;
    }
    .btnWhite:hover {
        background: #ff8400;
        color: white;
    }
    .btnOrangeNav[disabled] {
      cursor: not-allowed;
      background: #ff84009c;
      border: 3px solid #ff840024;
    }
    @media screen and (max-width: 1440px) {
      .btnWhite, .btnOrangeNav {
        padding: 10px 0;
      }
    }


</style>
