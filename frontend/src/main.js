import Vue from 'vue';
import App from './App.vue';
import router from './router';
import './registerServiceWorker';
import vuetify from './plugins/vuetify';
import './plugins/axios';
import './plugins/vueWindowSize';

Vue.config.productionTip = false;

new Vue({
    router,
    vuetify,
    render: function (h) {
        return h(App);
    }
}).$mount('#app');
