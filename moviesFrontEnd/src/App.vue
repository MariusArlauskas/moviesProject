<template>
  <v-app>
    <Header />
    <ProfileBar v-show="drawer" />
    <v-content class="mainBackground">
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
    setUser() {
      this.$store
        .dispatch("SET_USER")
        .then(() => {})
        .catch(() => {
          this.error = true;
        });
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
    this.setUser();
  }
};
</script>

<style>
.mainBackground {
  background: var(--v-background-base);
  /* background-image: url("~@/assets/bgpic.jpg"); */
}
.mainConteiner {
  margin-left: 12%;
  margin-right: 12%;
}

/* .whiteTransparent {
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.5);
} */
</style>
