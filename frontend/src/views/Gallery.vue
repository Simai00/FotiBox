<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col>
          <v-switch :label="`Sortierig umchehre`" v-model="sortDesc"/>
        </v-col>
        <v-col>
          <v-alert type="error" v-if="errorCount > 0">
            Es git momentan es Problemli mit dr Verbindig
          </v-alert>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          :key="image.id + '' + image.bwFilter"
          class="d-flex child-flex"
          cols="4"
          v-for="image in images"
        >
          <v-card class="d-flex" flat tile>
            <v-img
              :lazy-src="`${apiUrl}v1/image/${image.id}/preview?${image.id + image.bwFilter}`"
              :src="`${apiUrl}v1/image/${image.id}/medium?${image.id + image.bwFilter}`"
              @click="showImageDialog(image)"
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
    <v-overlay :value="loadingOverlay" :z-index="9999">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <v-dialog
      dark
      max-width="80%"
      v-model="dialogShow"
    >
      <v-card
        class="mx-auto"
      >
        <v-card-title>
          <v-btn
            @click="dialogShow = false"
            icon
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-spacer/>
          <v-btn @click="toggleBW()" color="primary" dark rounded>
            Schwarz-Wiss Filter
          </v-btn>
        </v-card-title>
        <v-img
          :key="dialogImage.id + '' + dialogImage.bwFilter"
          :lazy-src="`${apiUrl}v1/image/${dialogImage.id}/preview?${dialogImage.id + dialogImage.bwFilter}`"
          :max-height="windowHeight - 200"
          :src="`${apiUrl}v1/image/${dialogImage.id}/medium?${dialogImage.id + dialogImage.bwFilter}`"
          contain
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
    </v-dialog>
  </div>
</template>

<script>
    import Vue from 'vue';
    import { vueWindowSizeMixin } from 'vue-window-size';

    export default {
        name: 'Gallery',
        mixins: [vueWindowSizeMixin],
        data: function () {
            return {
                images: [],
                apiUrl: process.env.VUE_APP_apiUrl,
                autoLoadImages: true,
                dialogImage: {},
                dialogShow: false,
                loadingOverlay: false,
                sortDesc: true,
                errorCount: 0
            };
        },
        methods: {
            toggleBW () {
                this.loadingOverlay = true;
                Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/image/${this.dialogImage.id}/triggerBW`).then((response) => {
                    this.dialogImage = response.data;
                    this.loadingOverlay = false;
                });
            },
            showImageDialog (image) {
                this.dialogImage = image;
                this.dialogShow = true;
            },
            autoReload () {
                setTimeout(() => {
                    if (this.autoLoadImages && !this.dialogShow) {
                        Vue.axios.get(this.getGetImagesUrl())
                            .then((response) => {
                                this.images = response.data;
                                delete this.error;
                            })
                            .catch(() => {
                                this.errorCount++;
                            });
                    }
                    this.autoReload();
                }, 2000);
            },
            getGetImagesUrl () {
                if (this.sortDesc) {
                    return `${process.env.VUE_APP_apiUrl}v1/images/desc`;
                } else {
                    return `${process.env.VUE_APP_apiUrl}v1/images`;
                }
            },
            sleep (milliseconds) {
                return new Promise(resolve => setTimeout(resolve, milliseconds));
            }
        },
        mounted () {
            Vue.axios.get((this.getGetImagesUrl()))
                .then((response) => {
                    this.images = response.data;
                })
                .catch(() => {
                    this.errorCount++;
                });
            this.autoLoadImages = true;
            this.autoReload();
        },
        watch: {
            async errorCount (value) {
                if (value === 5) {
                    this.autoLoadImages = false;
                    await this.sleep(10000);
                    this.errorCount = 0;
                    this.autoLoadImages = true;
                }
            }
        },
        beforeDestroy () {
            this.autoLoadImages = false;
        }
    }
    ;
</script>

<style scoped>

</style>
