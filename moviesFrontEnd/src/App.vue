<template>
  <v-app>
    <Header />
    <ProfileBar v-show="drawer" />
    <v-content class="mainBackground" style="padding-top: 60px; height:95%; width:100%">
      <!-- <router-link to="/">Home</router-link> -->
      <router-view />
    </v-content>
    <Footer />
    <Notification />
  </v-app>
</template>

<script>
import { mapGetters } from "vuex";
import Header from "./components/navBars/Header";
import Footer from "./components/navBars/Footer";
import ProfileBar from "./components/navBars/ProfileBar";
import Notification from "./components/Notification";
export default {
  name: "App",
  components: { Header, Footer, ProfileBar, Notification },
  data: () => ({}),
  methods: {
    getUser() {
      this.$store.commit("SET_USER_FROM_SESSION");
    }
  },
  computed: {
    ...mapGetters(["GET_USER_DRAWER"]),
    drawer: {
      get() {
        return this.$store.getters.GET_USER_DRAWER;
      },
      set() {}
    }
  },
  beforeMount() {
    // Cookies do not get saved on localhost so redirect
    let url = window.location.href.split("/")[2];
    if (url != "127.0.0.1:8080") {
      window.location.href = "http://127.0.0.1:8080/";
    }
    this.getUser();
  }
};
</script>

<style>
.mainBackground {
  background: var(--v-background-base);
  /* background-image: url("~@/assets/bgpic.jpg"); */
}
.mainContainer {
  margin-left: 10.5%;
  margin-right: 10.5%;
  max-width: 79%;
}

html::-webkit-scrollbar {
  display: none;
}
html {
  scrollbar-width: none;
}

/* .whiteTransparent {
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.5);
} */
</style>
