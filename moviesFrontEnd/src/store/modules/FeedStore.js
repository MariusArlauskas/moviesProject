import axios from "axios";

const state = {
};

const getters = {
};

const actions = {
  GET_MESSAGES: (commit, { page, id }) => {
    return new Promise((resolve, reject) => {
      axios.get('messages/' + page + '/' + id)
        .then(({ data, status }) => {
          if (status === 200) {
            resolve(data);
          }
        })
        .catch(error => {
          reject(error);
        })
    })
  },
  GET_USERS_MESSAGES: (commit, { offset, userId }) => {
    return axios.get('users/' + userId + '/messages/' + offset)
      .then(({ data, status }) => {
        if (status === 200) {
          return data;
        }
      })
  },
  GET_MOVIE_MESSAGES: (commit, { offset, movieId }) => {
    return axios.get('movies/' + movieId + '/messages/' + offset)
      .then(({ data, status }) => {
        if (status === 200) {
          return data;
        }
      })
  },
  POST_MESSAGE: (commit, { message, parentId, movieId }) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`messages`, { message: message, parentId: parentId, movieId: movieId })
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
