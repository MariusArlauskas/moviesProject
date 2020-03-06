import axios from "axios";

const state = {
  movies: [],
};

const getters = {
  GET_MOVIES: state => {
    return state.movies;
  },
};

const actions = {
  GET_MOVIES: ({ commit }) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`movies`)
        .then(({ data, status }) => {
          if (status === 200) {
            commit('SET_MOVIES', data.results);
            resolve(true);
          }
        })
        .catch(error => {
          reject(error);
        })
    });
  },
};

const mutations = {
  SET_MOVIES: (state, movies) => {
    state.movies = movies;
  },
};

export default {
  state,
  getters,
  mutations,
  actions
};
