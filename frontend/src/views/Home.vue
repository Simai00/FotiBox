<template>
    <div>
        <v-img src="https://picsum.photos/510/300?random" aspect-ratio="2"></v-img>
        <div v-if="countDownStarted">
            <p>{{countDown}}</p>
        </div>
        <v-btn :disabled="countDownStarted || cameraStatus === 'offline'" @click="startCountDown()">Schiess es Fotti!
        </v-btn>
        <v-chip :color="getCameraStatusColor()" text-color="white" v-if="cameraStatus">
            {{getCameraStatusText()}}
        </v-chip>
    </div>
</template>
<script>
    import Vue from 'vue';

    export default {
        data: function () {
            return {
                countDown: Number,
                countDownStarted: false,
                cameraName: 'Sony Alpha 7ii',
                cameraStatus: 'online',
                autoReloadCameraStatus: true
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
            },
            getCameraStatus () {
                setTimeout(() => {
                    Vue.axios.get(`${process.env.VUE_APP_apiUrl}v1/camera/status`).then((response) => {
                        this.cameraName = response.data.name;
                        this.cameraStatus = response.data.status;
                    });
                    if (this.autoReloadCameraStatus) {
                        this.getCameraStatus();
                    }
                }, 4000);
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
        mounted () {
            this.getCameraStatus();
        },
        beforeDestroy () {
            this.autoReloadCameraStatus = false;
        }
    };

</script>

<style scoped>

</style>
