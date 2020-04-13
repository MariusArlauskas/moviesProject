import axios from "axios";

const state = {
};

const getters = {
};

const actions = {
  GET_MESSAGES: (commit, { page, id }) => {
    return axios.get('messages/' + page + '/' + id)
      .then(({ data, status }) => {
        if (status === 200) {
          return data;
        }
      })
  },
  POST_MESSAGE: (commit, msg) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`messages`, { message: msg })
        .then(({ data, status }) => {
          if (status === 200) {
            resolve(data);
          }
        })
        .catch(error => {
          reject(error);
        })
    });
  }
};

const mutations = {
};

export default {
  state,
  getters,
  mutations,
  actions
};
