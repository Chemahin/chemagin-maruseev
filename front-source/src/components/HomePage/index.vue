<template>
    <div>
        <HomeHeader></HomeHeader>
        <HomeSpecialistScill></HomeSpecialistScill>
        <HomeThreeQuestions></HomeThreeQuestions>
        <HomeCompanies></HomeCompanies>
        <HomeSpecialistsSlider></HomeSpecialistsSlider>
        <HomeDeirectionsDevelop></HomeDeirectionsDevelop>
        <HomeWerktHet></HomeWerktHet>
        <HomeOurClients></HomeOurClients>
        <HomeFastRegistrate></HomeFastRegistrate>
    </div>
</template>
<script>
    import HomeHeader from './HomeHeader';
    import HomeSpecialistScill from './HomeSpecialistScill';
    import HomeThreeQuestions from './HomeThreeQuestions';
    import HomeCompanies from './HomeCompanies';
    import HomeSpecialistsSlider from './HomeSpecialistsSlider';
    import HomeDeirectionsDevelop from './HomeDeirectionsDevelop';
    import HomeWerktHet from './HomeWerktHet';
    import HomeOurClients from './HomeOurClients';
    import HomeFastRegistrate from './HomeFastRegistrate';
    export default {
        components:{
            HomeHeader,
            HomeSpecialistScill,
            HomeThreeQuestions,
            HomeCompanies,
            HomeSpecialistsSlider,
            HomeDeirectionsDevelop,
            HomeWerktHet,
            HomeOurClients,
            HomeFastRegistrate,

        }
    }
</script>
<style lang="scss">

  @media screen and (max-width:320px) {
    body {
      overflow-x: hidden;
    }
    .row {
      margin: 0;
    }

  }

</style>
