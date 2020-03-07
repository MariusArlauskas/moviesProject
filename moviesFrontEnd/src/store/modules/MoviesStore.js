import axios from "axios";

const state = {
  movies: [],
  rowSize: 3,       // How many items in a row is shown
  leftOutMovies: [],
  totalPages: 0,
};

const getters = {
  GET_MOVIES: state => {
    return state.movies;
  },
  GET_TOTAL_PAGES: state => {
    return state.totalPages;
  }
};

const actions = {
  GET_MOVIES: ({ commit }, page) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`movies/page/` + page)
        .then(({ data, status }) => {
          if (status === 200) {
            commit('ADD_MOVIES', data);
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
  ADD_MOVIES: (state, movies) => {
    if (state.totalPages == 0) {
      state.totalPages = movies.total_pages;
      state.movies = movies.results;
    }
    let tempList = [...state.movies, ...state.leftOutMovies, ...movies.results];
    state.movies = tempList.filter(function (item, pos) {   // Removing duplicates
      return tempList.indexOf(item) == pos;
    });
  },
};

export default {
  state,
  getters,
  mutations,
  actions
};
