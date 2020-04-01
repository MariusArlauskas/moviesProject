import axios from "axios";

const state = {
};

const getters = {
};

const actions = {
  FIND_MOVIE: (commit, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`movie/` + payload)
        .then(({ data, status }) => {
          if (status === 200) {
            resolve(data)
          }
        })
        .catch(error => {
          reject(error)
        })
    });
  },
  GET_MOVIES: (commit, page) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`movies/page/` + page)
        .then(({ data, status }) => {
          if (status === 200) {
            resolve(data);
          }
        })
        .catch(error => {
          reject(error);
        })
    });
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
