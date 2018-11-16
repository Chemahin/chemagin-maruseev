<template>
    <div class='carousel-view'>
        <transition-group
                class='carousel'
                tag="div">
            <div v-for="slide in slides"
                 class='slide'
                 :key="slide.id">
                <img :src="slide.img" alt="slieImg">
            </div>
        </transition-group>
        <div class='carousel-controls'>
            <button class='carousel-controls__button' @click="previous">
                <img :src="mysrc2" alt="left">
            </button>
            <button class='carousel-controls__button' @click="next">
                <img :src="mysrc3" alt="left">
            </button>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                mysrc1:require(`../assets/header-illustration.png`),
                mysrc2:require(`../assets/icons/left.png`),
                mysrc3:require(`../assets/icons/right.png`),
                slides: [
                    {
                        img: require(`../assets/CauseffectSl1.png`),
                        id: 1
                    },
                    {
                        img: require(`../assets/CauseffectSl2.png`),
                        id: 2
                    },
                    {
                        img: require(`../assets/CauseffectSl1.png`),
                        id: 3
                    },
                ]
            }
        },
        methods: {
            next () {
                const first = this.slides.shift()
                this.slides = this.slides.concat(first)
            },
            previous () {
                const last = this.slides.pop()
                this.slides = [last].concat(this.slides)
            }
        },
      props: ['portfolio'],
    }
</script>
<style scoped>
    img{
        width: 100%;
        height:100%;
    }
    .carousel-view {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .carousel {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        width: 100%;
        min-height: 25em;
    }
    .slide {
        flex: 0 0 100%;
        margin: 1em 1em 0 1em;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    }
    .slide:first-of-type {
        opacity: 0;
    }
    .slide:last-of-type {
        opacity: 0;
    }
    .carousel-controls{
        position: absolute;
        left: 58%;
        bottom: 6%;
    }
    .carousel-controls__button{
        margin-right: 17px;
        border: none;
        background-color: transparent;
    }
    @media screen and (max-width: 767px){
        .carousel-controls{
            left: 43%;
        }
    }
</style>
