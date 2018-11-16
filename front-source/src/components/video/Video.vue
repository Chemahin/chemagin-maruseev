<template>
  <vimeo-player
    ref="player"
    :video-id="videoID"
    @ready="onReady"
    :progress="0"
    :player-height="height"
    :player-width="width"
    :loop="true"
    >
  </vimeo-player>
</template>
<script>
  export default {
    data() {
      return {
        autoplays: true,
        videoID: '261350725',
        height: 500,
        width: 800,
        options: {},
        playerReady: false
      }
    },
    methods: {
      onReady() {
        this.playerReady = true;
      },
      play () {
        this.$refs.player.play()
      },
      pause () {
        this.$refs.player.pause()
      }
    }
  }
</script>

