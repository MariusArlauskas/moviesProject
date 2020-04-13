import axios from "axios";

const state = {
};

const getters = {
};

const actions = {
  GET_MESSAGES: (commit, page) => {
    return axios.get('messages/' + page)
      .then(({ data, status }) => {
        if (status === 200) {
          return data;
        }
      })
  },
};

const mutations = {
};

export default {
  state,
  getters,
  mutations,
  actions
};
