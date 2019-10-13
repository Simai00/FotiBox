<template>
    <v-card max-width="500"
            class="mx-auto">
        <v-card-title>FottiBox</v-card-title>
        <v-card-text>
            <v-img src="https://picsum.photos/510/300?random" aspect-ratio="2"></v-img>
            <div v-if="countDownStarted">
                <p>{{countDown}}</p>
            </div>
        </v-card-text>
        <v-card-actions>
            <v-btn :disabled="countDownStarted" @click="startCountDown()">Schiess es Fotti!</v-btn>
        </v-card-actions>
    </v-card>
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

