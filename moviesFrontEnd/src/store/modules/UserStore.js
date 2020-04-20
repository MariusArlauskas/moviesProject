import axios from "axios";

const state = {
  profileInfoLinks: [
    { title: "Activities", icon: "mdi-view-dashboard", href: "HomePage" },
    { title: "Movies", icon: "list", href: "HomePage" },
    { title: "Social", icon: "mdi-help-box", href: "HomePage" }
  ],
  user: {},
  drawer: false         // Show profile bar 
};

const getters = {
  GET_PROFILE_INFO_LINKS: state => {
    return state.profileInfoLinks;
  },
  GET_USER_DRAWER: state => {
    return state.drawer;
  },
  GET_USER: state => {
    if (Object.keys(state.user).length < 2) {
      return false;
    }
    if (state.user.role.includes('_')) {
      let role = state.user.role
        .split("_")[1]
        .toLowerCase();
      role = role.charAt(0).toUpperCase() + role.slice(1)
      state.user.role = role;
    }
    return state.user;
  }
};

const actions = {
  GET_USERS: () => {
    return new Promise((resolve, reject) => {
      axios
        .get('users')
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
  GET_USER_MOVIES_LIST: (commit, userId) => {
    return new Promise((resolve, reject) => {
      axios
        .get(`users/` + userId + `/movies`)
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
  GET_USER_PROFILE_BY_ID: (commit, payload) => {
    return axios.get(`profile/` + payload.id)
      .then(({ data, status }) => {
        if (status === 200) {
          return data;
        }
      })
  },
  LOGOUT: ({ commit }) => {
    axios.post(`logout`)
      .then(() => {
        commit("UNSET_USER");
      })
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
  REGISTER: (commit, { email, password, name, birthDate }) => {
    return new Promise((resolve, reject) => {
      axios.post(`register`, {
        email, password, name, birthDate
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
  UPDATE_USER: ({ commit }, { id, name, description, password }) => {
    return new Promise((resolve, reject) => {
      axios.post(`profile/` + id + '/update', {
        name, description, password
      })
        .then(({ data, status }) => {
          if (status === 200) {
            commit("UPDATE_USER_SESSION", data);
            resolve(true)
          }
        })
        .catch(error => {
          reject(error);
        })
    })
  },
  UPLOAD_USER_PICTURE: ({ commit }, [id, profilePicture]) => {
    return new Promise((resolve, reject) => {
      axios.post(`profile/` + id + '/update',
        profilePicture,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then(({ data, status }) => {
          if (status === 200) {
            commit("UPDATE_USER_SESSION", data);
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
  UPDATE_USER_SESSION: (state, user) => {  // Sets users data to local and session storage
    // Update data
    if (typeof user.id == 'undefined' && user.id == '') {
      return
    }
    // User
    state.user = user;
    // Session
    sessionStorage.setItem('user', JSON.stringify(user));
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
