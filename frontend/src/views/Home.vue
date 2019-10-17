<template>
    <div>
        <v-img src="https://picsum.photos/510/300?random" aspect-ratio="2"></v-img>
        <div v-if="countDownStarted">
            <p>{{countDown}}</p>
        </div>
        <v-btn :disabled="countDownStarted" @click="startCountDown()">Schiess es Fotti!</v-btn>
    </div>
</template>
<script>

  export default {
    data: function () {
      return {
        countDown: Number,
        countDownStarted: false
      };
    },
    methods: {
      startCountDown () {
        if (!this.countDownStarted) {
          this.countDown = 5;
          this.countDownStarted = true;
          this.countDownTimer();
        }
      },
      countDownTimer () {
        if (this.countDown > 0) {
          setTimeout(() => {
            this.countDown -= 1;
            this.countDownTimer();
          }, 1000);
        } else {
          this.countDownStarted = false;
        }
      }
    }
  };

</script>

<style scoped>

</style>
