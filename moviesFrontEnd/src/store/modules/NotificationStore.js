const state = {
  notification: {
    display: false,
    text: "Notification placeholder text",
    timeout: 4000,
    class: 'success'
  },
};

const getters = {
  NOTIFICATION: state => {
    return state.notification;
  }
};

const actions = {
};

const mutations = {
  SET_NOTIFICATION: (state, { display, text, alertClass }) => {
    state.notification.display = display;
    state.notification.text = text;
    state.notification.class = alertClass;
  },
};

export default {
  state,
  getters,
  mutations,
  actions
};
