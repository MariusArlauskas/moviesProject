const state = {
  webTitle: "Movies Society",
  headerLinks: [
    { name: "Home", icon: "mdi-view-dashboard", href: "HomePage", classes: 'white--text', showWhenLoggedIn: true },
    { name: "Movies", icon: "list", href: "Movies", classes: 'white--text', showWhenLoggedIn: true },
    { name: "Login", icon: "keyboard_arrow_right", href: "Login", classes: 'accent--text text--lighten-2', showWhenLoggedIn: false },
    { name: "SignUp", icon: "keyboard_arrow_right", href: "SignUp", classes: 'secondary--text text--lighten-4', showWhenLoggedIn: false },
    { name: "About", icon: "mdi-help-box", href: "AboutPage", classes: 'white--text', showWhenLoggedIn: true }
  ],
  profileAdminLinks: [
    { title: "Admin menu", icon: "settings_applications", href: "AdminUsers", params: {} },
  ],
  profileLinks: [
    { title: "Home", icon: "mdi-view-dashboard", href: "HomePage", params: {} },
    { title: "Profile", icon: "person", href: "ProfileMainWall", params: { name: 'id', method: 'this.getUserId' } },
    { title: "My movies", icon: "list", href: "ProfileMoviesList", params: { name: 'id', method: 'this.getUserId' } },
    { title: "Settings", icon: "settings", href: "ProfileEditProfile", params: { name: 'id', method: 'this.getUserId' } },
    { title: "About", icon: "mdi-help-box", href: "AboutPage", params: {} }
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
  GET_ADMIN_PROFILE_LINKS: () => {
    return state.profileAdminLinks
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
