import Vue from "vue";
import Vuex from "vuex";

import GlobalStore from "./modules/GlobalStore";
import UserStore from "./modules/UserStore";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    GlobalStore,
    UserStore
  }
});
