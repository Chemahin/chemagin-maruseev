<template>
  <div>
    <ProfileHeader></ProfileHeader>
    <SpecialistCard></SpecialistCard>
    <Experience></Experience>
    <Carousel></Carousel>
    <Reviews></Reviews>

  </div>
</template>

<script>
  import ProfileHeader from './ProfileHeader';
  import SpecialistCard from './SpecialistCard';
  import Experience from './Experience';
  import Carousel from './Carousel';
  import Reviews from './Reviews';

  export default {
    components: {
      ProfileHeader,
      SpecialistCard,
      Experience,
      Carousel,
      Reviews
    },
    methods: {
      scrollToTop() {
        window.scrollTo(0, 0);
      }
    },
    mounted() {
      this.scrollToTop();
    },
  }
</script>

<style scoped lang="scss">

</style>

