import axios from "axios";

const state = {
};

const getters = {
};

const actions = {
  ADD_MOVIE_STATUS: (commit, { userId, movieId, relationType }) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`users/` + userId + `/1/movies/` + movieId + `/status/` + relationType)
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
  // FIND_MOVIE: (commit, payload) => {
  // return new Promise((resolve, reject) => {
  //   axios
  //     .get(`movie/` + payload)
  //     .then(({ data, status }) => {
  //       if (status === 200) {
  //         resolve(data)
  //       }
  //     })
  //     .catch(error => {
  //       reject(error)
  //     })
  // });
  // },
  GET_MOVIES: (commit, { page, userId }) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`movies/page/` + page + '/user/' + userId)
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
  GET_MOVIES_ADD_TYPES: () => {
    return axios.get(`lists/types`)
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
