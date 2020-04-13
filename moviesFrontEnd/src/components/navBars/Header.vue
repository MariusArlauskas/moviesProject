<template>
  <v-navigation-drawer
    width="100%"
    height="auto"
    dark
    color="var(--v-primary-base)"
    style="padding-left: 0px"
    permanent
    fixed
    v-show="showNavbar"
  >
    <v-toolbar-title style="width: 180px; float: left;" class="ml-3 mr-10">
      <router-link :to="{ name: 'HomePage' }">
        <v-row class="ml-0 my-2" align="center">
          <v-avatar size="35px" color="var(--v-primary-lighten5)" class="mr-2">
            <v-img contain max-height="33px" max-width="33px" src="../../assets/logo.png"></v-img>
          </v-avatar>
          <v-content class="py-0 white--text">{{ GET_WEB_TITLE }}</v-content>
        </v-row>
      </router-link>
    </v-toolbar-title>

    <v-toolbar-items
      style="float: left"
      v-for="link in links"
      :key="link.name"
      class="font-weight-light mr-3 header-href"
    >
      <router-link :class="link.classes" :to="{ name: link.href }">{{ link.name }}</router-link>
    </v-toolbar-items>

    <SearchDialog />
  </v-navigation-drawer>
</template>

<script>
import SearchDialog from "../SearchDialog";
import { mapGetters } from "vuex";
export default {
  name: "Header",
  components: { SearchDialog },
  data: () => {
    return {
      showNavbar: true,
      lastScrollPosition: 0
    };
  },
  methods: {
    onScroll() {
      const currentScrollPosition =
        window.pageYOffset || document.documentElement.scrollTop;
      // Because of momentum scrolling on mobiles, we shouldn't continue if it is less than zero
      if (currentScrollPosition < 0) {
        return;
      }
      if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 60) {
        return;
      }
      this.showNavbar = currentScrollPosition < this.lastScrollPosition;
      this.lastScrollPosition = currentScrollPosition;
    }
  },
  computed: {
    ...mapGetters(["GET_WEB_TITLE", "GET_HEADER_LINKS", "GET_USER"]),
    links: {
      get() {
        let array = this.$store.getters.GET_HEADER_LINKS;
        if (this.$store.getters.GET_USER) {
          return array.filter(function(e) {
            return e.showWhenLoggedIn == true;
          });
        } else {
          return array;
        }
      },
      set() {}
    }
  },
  mounted() {
    window.addEventListener("scroll", this.onScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  }
};
</script>

<style scoped>
div a {
  text-decoration: none;
}
.header-href {
  margin-top: 13.5px;
}
.search {
  margin-right: 15%;
}
</style>
