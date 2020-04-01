const state = {
  webTitle: "Movies Society",
  headerLinks: [
    { name: "Home", href: "HomePage", classes: 'white--text', showWhenLoggedIn: true },
    { name: "Movies", href: "Movies", classes: 'white--text', showWhenLoggedIn: true },
    { name: "Login", href: "Login", classes: 'accent--text text--lighten-2', showWhenLoggedIn: false },
    { name: "SignUp", href: "SignUp", classes: 'secondary--text text--lighten-4', showWhenLoggedIn: false }
  ],
  profileLinks: [
    { title: "Home", icon: "mdi-view-dashboard", href: "HomePage" },
    { title: "My movies", icon: "list", href: "HomePage" },
    { title: "About", icon: "mdi-help-box", href: "HomePage" }
  ]
};

const getters = {
  GET_WEB_TITLE: () => {
    return state.webTitle
  },
  GET_HEADER_LINKS: () => {
    return state.headerLinks
  },
  GET_PROFILE_LINKS: () => {
    return state.profileLinks
  },
};

const actions = {};

const mutations = {};

export default {
  state,
  getters,
  mutations,
  actions
};
