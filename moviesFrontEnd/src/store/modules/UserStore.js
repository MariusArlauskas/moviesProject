import axios from "axios";

const state = {
  id: "",
  user: {},
  drawer: false         // Show profile bar 
};

const getters = {
  GET_USER_DRAWER: state => {
    return state.drawer;
  },
  GET_USER: state => {
    if (Object.keys(state.user).length < 2) {
      return false;
    }
    let role = state.user.role
      .split("_")[1]
      .toLowerCase();
    role = role.charAt(0).toUpperCase() + role.slice(1)
    state.user.role = role;
    return state.user;
  }
};

const actions = {
  GET_USER_PROFILE: ({ commit }, payload) => {
    axios.get(`profile/` + payload)
      .then(({ data, status }) => {
        if (status === 200) {
          commit("SET_USER_SESSION", data);
        }
      })
  },
  LOGOUT: ({ commit }) => {
    return new Promise((resolve) => {
      axios.post(`logout`)
        .then(() => {
          commit("UNSET_USER");
          resolve(true);
        })
    });
  },
  LOGIN: ({ dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`login_check`, payload)
        .then(({ status }) => {
          if (status === 200) {
            dispatch('SET_USER', payload);
            resolve(true);
          }
        })
        .catch(error => {
          reject(error);
        })
    });
  },
  REGISTER: (commit, { email, password, name }) => {
    return new Promise((resolve, reject) => {
      axios.post(`register`, {
        email, password, name
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
  SET_USER: ({ commit }) => {   // Get user profile and set its data
    axios.get(`profile`)
      .then(({ data, status }) => {
        if (status === 200) {
          commit("SET_USER_SESSION", data);
        }
      })
  },
  SET_USER_FROM_SESSION: ({ commit }) => {  // On page refresh - reload user
    commit("SET_USER_FROM_SESSION");
  },
};

const mutations = {
  SET_USER_SESSION: (state, user) => {  // Sets users data to local and session storage
    // Session
    sessionStorage.setItem('user', JSON.stringify(user));
    // User
    state.user = user;
    // Profile bar
    state.drawer = true;
  },
  SET_USER_FROM_SESSION: (state) => {   // Sets users data from session to local
    if (sessionStorage.getItem('user')) {
      state.user = JSON.parse(sessionStorage.getItem('user'));
      state.drawer = true;
    }
  },
  UNSET_USER: (state) => {  // Unsets users data and session
    sessionStorage.clear();
    state.user = {};
    state.drawer = false;
  }
};

export default {
  state,
  getters,
  mutations,
  actions
};
