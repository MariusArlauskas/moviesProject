"use strict";

import Vue from 'vue';
import axios from "axios";

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
axios.defaults.withCredentials = true;
// Full config:  https://github.com/axios/axios#request-config
// axios.defaults.baseURL = process.env.baseURL || process.env.apiUrl || '';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
// axios.defaults.headers.post['Content-Type'] = 'application/json';

let config = {
  // baseURL: 'http://127.0.0.1:8000/api/', // doesn't work for some reason
  // timeout: 60 * 1000, // Timeout
  // withCredentials: true, // Check cross-site Access-Control
};

const _axios = axios.create(config);

_axios.interceptors.request.use(
  function (config) {
    // Do something before request is sent
    return config;
  },
  function (error) {
    // Do something with request error
    return Promise.reject(error);
  }
);

import store from "../store/index";
import router from '../router/index';

// Add a response interceptor
axios.interceptors.response.use(
  function (response) {
    // Do something with response data
    return response;
  },
  function (error) {
    // && (this.$route.name != 'Login' || this.$route.name != 'Signup')
    if ((error.response.status == 401 || error.response.status == 403)) {
      store.dispatch("LOGOUT").then(() => {   // Loggout user when session expires
        if (router.currentRoute.name != 'Login') {
          router.push("/login");
          store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Please login!",
            alertClass: "warning"
          });
        }

      })
    }
    return Promise.reject(error);
  }
);

Plugin.install = function (Vue) {
  Vue.axios = _axios;
  window.axios = _axios;
  Object.defineProperties(Vue.prototype, {
    axios: {
      get() {
        return _axios;
      }
    },
    $axios: {
      get() {
        return _axios;
      }
    },
  });
};

Vue.use(Plugin)

export default Plugin;
