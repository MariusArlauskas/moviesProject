const state = {
  webTitle: "Movies Society",
  headerLinks: [
    { name: "Home", href: "HomePage", showWhenLoggedIn: true },
    { name: "Movies", href: "Movies", showWhenLoggedIn: true },
    { name: "Login", href: "Login", showWhenLoggedIn: false },
    { name: "SignUp", href: "SignUp", showWhenLoggedIn: false }
  ],
  profileLinks: [
    { title: "Home", icon: "mdi-view-dashboard", href: "HomePage" },
    { title: "Profile", icon: "person", href: "HomePage" },
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
  }
};

const actions = {};

const mutations = {};

export default {
  state,
  getters,
  mutations,
  actions
};
