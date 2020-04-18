import Vue from 'vue';
import './plugins/axios';
import App from './App.vue';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import InfiniteLoading from 'vue-infinite-loading';
import CommentBox from './components/HomePage/Feed/CommentBox';
import FeedItem from './components/HomePage/Feed/FeedItem';

Vue.config.productionTip = false;

new Vue({
  InfiniteLoading,
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')

Vue.component('CommentBox', CommentBox)
Vue.component('FeedItem', FeedItem)