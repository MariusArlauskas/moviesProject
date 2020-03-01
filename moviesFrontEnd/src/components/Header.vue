<template>
  <v-navigation-drawer
    width="auto"
    height="auto"
    dark
    color="var(--v-primary-base)"
    style="padding-left: 0px"
    permanent
  >
    <v-toolbar-title style="width: 180px; float: left;" class="ml-3 mr-10">
      <a href="/">
        <v-row class="ml-0 my-2" align="center">
          <v-avatar size="35px" color="var(--v-primary-lighten5)" class="mr-2">
            <v-img contain max-height="33px" max-width="33px" src="../assets/logo.png"></v-img>
          </v-avatar>
          <v-content class="py-0 white--text">{{ GET_WEB_TITLE }}</v-content>
        </v-row>
      </a>
    </v-toolbar-title>

    <v-toolbar-items
      style="float: left"
      v-for="link in links"
      :key="link.name"
      class="font-weight-light mr-3 header-href"
    >
      <router-link class="white--text" :to="{ name: link.href }">{{ link.name }}</router-link>
    </v-toolbar-items>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Header",
  data: () => ({}),
  computed: {
    ...mapGetters(["GET_WEB_TITLE", "GET_HEADER_LINKS", "GET_USER"]),
    links: {
      get() {
        let array = this.$store.getters.GET_HEADER_LINKS;
        if (this.$store.getters.GET_USER.name) {
          return array.filter(function(e) {
            return e.showWhenLoggedIn == true;
          });
        } else {
          return array;
        }
      },
      set() {}
    }
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
</style>
