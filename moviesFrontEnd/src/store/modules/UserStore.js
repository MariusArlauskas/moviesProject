import axios from "axios";

const state = {
  name: "",
  email: "",
  role: "ROLE_GUEST",
  drawer: false         // Show profile bar 
};

const getters = {
  GET_USER_DRAWER: state => {
    return state.drawer;
  },
  GET_USER: state => {
    let role = state.role
      .split("_")[1]
      .toLowerCase();
    role = role.charAt(0).toUpperCase() + role.slice(1)
    return {
      name: state.name,
      email: state.email,
      role: role
    };
  }
};

const actions = {
  LOGOUT: ({ commit }) => {
    return new Promise((resolve, reject) => {
      axios.post(`logout`)
        .then(({ status }) => {
          if (status === 200) {
            commit("UNSET_USER");
            resolve(true);
          }
        })
        .catch(error => {
          reject(error);
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
  SET_USER_FROM_SESSION: ({ commit }) => {  // On refresh reload user
    commit("SET_USER_FROM_SESSION");
  },
};

const mutations = {
  SET_USER_SESSION: (state, user) => {  // Sets users data to local and session storage
    // Session
    sessionStorage.setItem('user_name', user.name);
    sessionStorage.setItem('user_email', user.email);
    sessionStorage.setItem('user_role', user.role);
    // User
    state.name = user.name;
    state.email = user.email;
    state.role = user.role;
    // Profile bar
    state.drawer = true;
  },
  SET_USER_FROM_SESSION: (state) => {   // Sets users data from session to local
    if (sessionStorage.getItem('user_name')) {
      state.name = sessionStorage.getItem('user_name');
      state.email = sessionStorage.getItem('user_email');
      state.role = sessionStorage.getItem('user_role');
      state.drawer = true;
    }
  },
  UNSET_USER: (state) => {  // Unsets users data and session
    sessionStorage.clear();
    state.name = "";
    state.email = "";
    state.role = "ROLE_GUEST";
    state.drawer = false;
  }
};

export default {
  state,
  getters,
  mutations,
  actions
};
