<template>
  <div>
    <v-btn
      @click.stop="openTakeAPictureDialog()"
      absolute bottom color="pink" dark fab right
      x-large
    >
      <v-icon dark>mdi-camera</v-icon>
    </v-btn>

    <v-dialog
      max-width="80%"
      persistent
      v-model="takeAPictureDialog"
    >
      <v-card>
        <v-card-title class="headline">
          Mach e neus Foti
          <v-spacer/>
          <v-btn :disabled="countDownStarted || loadingTakeAPicture" @click="closeTakeAPictureDialog()" icon text
                 x-large>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text style="text-align: center">
          <v-btn :disabled="countDownStarted || cameraStatus === 'offline' || loadingTakeAPicture"
                 :loading="loadingTakeAPicture" @click="startCountDown()" color="green"
                 fab
                 height="100px"
                 ref="cameraButton"
                 style="font-size: 50px"
                 width="100px"
                 x-large
          >
            <v-icon v-if="!countDownStarted">mdi-camera</v-icon>
            <div v-if="countDownStarted">{{countDown}}</div>
          </v-btn>
        </v-card-text>
        <v-img
          :lazy-src="`${apiUrl}/v1/image/${image.id}/preview`"
          :src="`${apiUrl}/v1/image/${image.id}/medium`"
          :max-height="windowHeight / 3"
          v-if="image.id"
          contain
        />
        <v-card-actions>
          <v-chip :color="getCameraStatusColor()" text-color="white" v-if="cameraStatus">
            {{getCameraStatusText()}}
          </v-chip>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
    import Vue from 'vue';
    import { vueWindowSizeMixin } from 'vue-window-size';

    export default {
        name: 'TakeAPicture',
        mixins: [vueWindowSizeMixin],
        data: function () {
            return {
                apiUrl: process.env.VUE_APP_apiUrl,
                countDown: Number,
                countDownStarted: false,
                cameraName: '',
                cameraStatus: '',
                autoReloadCameraStatus: true,
                loadingTakeAPicture: false,
                takeAPictureDialog: false,
                image: {}
            };
        },
        methods: {
            captureImage () {
                this.loadingTakeAPicture = true;
                Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/camera/capture/image`).then((response) => {
                    this.loadingTakeAPicture = false;
                    this.image = response.data;
                });
            },
            openTakeAPictureDialog () {
                this.updateCameraStatus();
                this.startAutoReloadCameraStatus();
                this.takeAPictureDialog = true;
            },
            closeTakeAPictureDialog () {
                this.takeAPictureDialog = false;
                this.image = {};
                this.autoReloadCameraStatus = false;
            },
            startCountDown () {
                if (!this.countDownStarted) {
                    this.image = {};
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
                    this.captureImage();
                }
            },
            startAutoReloadCameraStatus () {
                setTimeout(() => {
                    this.updateCameraStatus();
                    if (this.autoReloadCameraStatus) {
                        this.startAutoReloadCameraStatus();
                    }
                }, 4000);
            },
            updateCameraStatus () {
                Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/camera/status`).then((response) => {
                    this.cameraName = response.data.name;
                    this.cameraStatus = response.data.status;
                });
            },
            getCameraStatusColor () {
                switch (this.cameraStatus) {
                case 'online':
                    return 'green';
                case 'offline':
                    return 'red';
                default:
                    return 'orange';
                }
            },
            getCameraStatusText () {
                if (this.cameraStatus === 'offline') {
                    return 'Kamera nicht erreichbar';
                }
                if (this.cameraName.length > 0) {
                    return this.cameraName;
                } else {
                    return 'Kamera';
                }
            }
        },
        beforeDestroy () {
            this.autoReloadCameraStatus = false;
        }
    };

</script>

<style scoped>

</style>
