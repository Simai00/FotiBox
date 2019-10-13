<template>
    <v-card max-width="500"
            class="mx-auto">
        <v-card-title>FottiBox</v-card-title>
        <v-card-text>
            <v-img src="https://picsum.photos/510/300?random" aspect-ratio="2"></v-img>
            <div>
                <p>{{countDown}}</p>
            </div>
        </v-card-text>
        <v-card-actions>
            <button v-on:click="countDownTimer">Schiess es Fotti!</button>
        </v-card-actions>
    </v-card>
</template>
<script>

  export default {
    data: () => ({
    methods: {
      countDownTimer () {
        if (this.countDown > 0) {
          setTimeout(() => {
            this.countDown -= 1;
            this.countDownTimer()
          }, 1000)
        }
      }
    }
  })
  }


</script>

<style scoped>

</style>

