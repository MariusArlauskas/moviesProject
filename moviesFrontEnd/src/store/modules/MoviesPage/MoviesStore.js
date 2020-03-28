import axios from "axios";

const state = {
  movies: [],
  rowSize: 3,       // How many items in a row is shown
  leftOutMovies: [],
  pagesEnd: 0,
};

const getters = {
  GET_MOVIES: state => {
    return state.movies
  },
  GET_PAGES_END: state => {
    return state.pagesEnd
  }
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
  GET_MOVIES: ({ commit }, page) => {
    if (page < 2) {
      commit('RESET_MOVIES')
    }
    return new Promise((resolve, reject) => {
      axios
        .get(`movies/page/` + page)
        .then(({ data, status }) => {
          if (status === 200) {
            commit('ADD_MOVIES', data)
            resolve(true)
          }
        })
        .catch(error => {
          reject(error)
        })
    });
  },
};

const mutations = {
  ADD_MOVIES: (state, movies) => {
    if (movies) {
      state.movies = [...state.movies, ...state.leftOutMovies, ...movies];
      // let tempList = [...state.movies, ...state.leftOutMovies, ...movies];

      // state.movies = tempList.filter(function (item, pos) {   // Removing duplicates
      //   return tempList.indexOf(item) == pos
      // });
    } else {
      state.pagesEnd = true;
    }
  },
  RESET_MOVIES: (state) => {
    state.movies = []
  }
};

export default {
  state,
  getters,
  mutations,
  actions
};
