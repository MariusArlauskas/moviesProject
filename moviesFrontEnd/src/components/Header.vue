<template>
  <nav>
    <v-toolbar height="auto" dark color="var(--v-primary-base)" style="padding-left: 0px">
      <v-toolbar-title style="width: 180px" class="mr-10">
        <a href="/">
          <v-row class="ml-0 my-2" align="center">
            <v-avatar size="35px" color="var(--v-primaryLight-base)" class="mr-2">
              <v-img contain max-height="33px" max-width="33px" src="../assets/logo.png"></v-img>
            </v-avatar>
            <v-content class="white--text">{{ getWebTitle }}</v-content>
          </v-row>
        </a>
      </v-toolbar-title>
      <v-container style="height:auto; width: auto" class="mx-0">
        <v-toolbar-items
          style="float: left"
          v-for="link in links"
          :key="link.name"
          class="font-weight-light mr-3"
        >
          <router-link class="white--text" :to="{ name: link.href }">{{ link.name }}</router-link>
        </v-toolbar-items>
      </v-container>
    </v-toolbar>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Header",
  data: () => ({
    links: [
      { name: "Home", href: "HomePage" },
      { name: "Login", href: "Login" },
      { name: "SignUp", href: "SignUp" }
    ]
  }),
  computed: {
    ...mapGetters(["getWebTitle"])
  }
};
</script>

<style scoped>
div a {
  text-decoration: none;
}
</style>
