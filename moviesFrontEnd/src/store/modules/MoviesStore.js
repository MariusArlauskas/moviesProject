import axios from "axios";

const state = {
};

const getters = {
};

const actions = {
  ADD_MOVIE_STATUS: (commit, { userId, movieId, relationType }) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`users/` + userId + `/apis/1/movies/` + movieId + `/status/` + relationType)
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
  ADD_MOVIE_RATING: (commit, { userId, movieId, rating }) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`users/` + userId + `/apis/1/movies/` + movieId + `/rating/` + rating)
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
  GET_MOVIES: (commit, { page, userId, type, filter }) => {
    var req;
    if (typeof userId === 'undefined' || userId === null) {
      req = `movies/` + type + `/page/` + page;
    } else {
      req = `movies/` + type + `/page/` + page + '/user/' + userId;
    }
    console.log(filter);
    return new Promise((resolve, reject) => {
      axios
        .post(req, { filter: filter })
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
  GET_WEB_MOST_POPULAR_MOVIES_LIST: (commit, { page, userId }) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`movies/webMostPopular/page/` + page + `/M/` + userId)
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
  GET_FULL_MOVIE: (commit, id) => {
    return new Promise((resolve, reject) => {
      axios
        .get('movies/' + id)
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
  GET_MOVIES_GENRES: () => {
    return axios.get(`genres`)
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
