import Vue from 'vue';
import './plugins/axios';
import App from './App.vue';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import InfiniteLoading from 'vue-infinite-loading';

Vue.config.productionTip = false;

new Vue({
  InfiniteLoading,
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
