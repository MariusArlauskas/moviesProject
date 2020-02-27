import axios from "axios";

const state = {};

const getters = {};

const actions = {
  LOGIN: (commit, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`login_check`, payload)
        .then(({ status }) => {
          if (status === 200) {
            resolve(true);
          }
        })
        .catch(error => {
          reject(error);
        })
    });
  },
  REGISTER: (commit, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.post(`/users/register`, {
        email, password
      })
        .then(({ status }) => {
          if (status === 200) {
            resolve(true)
          }
        })
        .catch(error => {
          reject(error);
        })
    })
  },
};

const mutations = {};

export default {
  state,
  getters,
  mutations,
  actions
};
