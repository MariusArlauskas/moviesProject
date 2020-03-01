import axios from "axios";

const state = {
  name: "",
  email: "",
  role: "ROLE_GUEST",
  drawer: false
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
  SET_USER: async ({ commit }) => {
    await axios.get(`profile`)
      .then(({ data, status }) => {
        if (status === 200) {
          commit("SET_USER", data)
        }
      })
  },
};

const mutations = {
  SET_USER: (state, user) => {
    state.name = user.name;
    state.email = user.email;
    state.role = user.role;
    state.drawer = true;
  },
  UNSET_USER: (state) => {
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
