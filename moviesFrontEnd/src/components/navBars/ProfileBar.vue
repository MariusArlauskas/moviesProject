<template>
  <v-navigation-drawer
    style="border-bottom-left-radius:15px"
    height="auto"
    width="183px"
    color="primary"
    expand-on-hover
    :mini-variant="miniVariant"
    right
    dark
    fixed
    permanent
  >
    <v-list dense nav class="pt-0 transparent">
      <v-list-item two-line :class="miniVariant && 'px-0 mb-0'">
        <v-list-item-avatar>
          <img :src="GET_USER.profilePicture" />
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title>{{ GET_USER.name }}</v-list-item-title>
          <v-list-item-subtitle>{{ GET_USER.role }}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link @click="logout()">
        <v-list-item-icon>
          <v-icon class="accent--text text--lighten-2">exit_to_app</v-icon>
        </v-list-item-icon>
        <v-list-item-content
          class="accent--text subtitle-2 text--lighten-2"
          style="text-decoration: none;"
        >Logout</v-list-item-content>
      </v-list-item>

      <v-divider class="mb-1"></v-divider>

      <v-list-item v-for="item in items" :key="item.title" link>
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <router-link
            class="white--text subtitle-2"
            style="text-decoration: none;"
            :to="{ name: item.href, params: item.params }"
          >{{ item.title }}</router-link>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data: () => ({
    miniVariant: true,
    items: [
      { title: "Home", icon: "mdi-view-dashboard", href: "HomePage" },
      { title: "Profile", icon: "person", href: "Profile", params: { id: 0 } }
    ]
  }),
  computed: {
    ...mapGetters(["GET_USER", "GET_PROFILE_LINKS"])
  },
  methods: {
    getLinks() {
      if (this.$store.getters.GET_USER.id) {
        this.items[1].params = { id: this.$store.getters.GET_USER.id }; // Add user id to its profile link
      }
      this.items = [...this.items, ...this.$store.getters.GET_PROFILE_LINKS];
    },
    logout() {
      this.$store
        .dispatch("LOGOUT")
        .then(() => {
          if (this.$router.path !== "/login") {
            this.$router.push("/login");
          }
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Logged out!",
            alertClass: "error"
          });
        })
        .catch(() => {});
    }
  },
  mounted() {
    this.getLinks();
  }
};
</script>

<style scoped>
.a {
  text-decoration: none;
  color: white;
}
</style>