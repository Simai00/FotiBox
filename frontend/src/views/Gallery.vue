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
  </v-container>
</template>

<script>
    import Vue from 'vue';

    export default {
        name: 'Gallery',
        data: function () {
            return {
                images: [],
                apiUrl: process.env.VUE_APP_apiUrl
            };
        },
        mounted () {
            Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/images`).then((response) => {
                this.images = response.data;
            });
        }
    };
</script>

<style scoped>

</style>
