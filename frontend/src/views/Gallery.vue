<template>
  <v-container fluid>
    <v-row>
      <v-col
        :key="image.id"
        class="d-flex child-flex"
        cols="4"
        v-for="image in images"
      >
        <v-card class="d-flex" flat tile>
          <v-img
            :lazy-src="`${apiUrl}/v1/image/${image.id}/preview`"
            :src="`${apiUrl}/v1/image/${image.id}/medium`"
            aspect-ratio="1"
            class="grey lighten-2"
            @click="overlay = !overlay"
          >
            <template v-slot:placeholder>
              <v-row
                align="center"
                class="fill-height ma-0"
                justify="center"
              >
                <v-progress-circular color="grey lighten-5" indeterminate></v-progress-circular>
              </v-row>
            </template>
          </v-img>
        </v-card>
      </v-col>
    </v-row>
    <v-overlay
            :absolute="absolute"
            :opacity="opacity"
            :value="overlay">
      <v-btn
              icon
              @click="overlay = false"
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
      <div class="text-right">
        <v-btn rounded color="success" dark
               @click=""

        >Filter aktivieren</v-btn>
        <v-btn rounded color="error" dark
               @click=""

        >Filter deaktivieren</v-btn>
      </div>

    </v-overlay>
  </v-container>
</template>

<script>
    import Vue from 'vue';

    export default {
        name: 'Gallery',
        data: function () {
            return {
                images: [],
                apiUrl: process.env.VUE_APP_apiUrl,
                autoLoadImages: true
            };
        },
        methods: {
            autoReload () {
                setTimeout(() => {
                    Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/images`).then((response) => {
                        this.images = response.data;
                    });
                    if (this.autoLoadImages) {
                        this.autoReload();
                    }
                }, 1000);
            }
        },
        mounted () {
            Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/images`).then((response) => {
                this.images = response.data;
            });
            this.autoLoadImages = true;
            this.autoReload();
        },
        beforeDestroy () {
            this.autoLoadImages = false;
        }
    };
</script>

<style scoped>

</style>
