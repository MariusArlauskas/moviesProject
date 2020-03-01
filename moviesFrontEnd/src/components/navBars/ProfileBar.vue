<template>
  <v-navigation-drawer
    style="border-bottom-left-radius:15px"
    height="auto"
    width="183px"
    v-model="drawer"
    color="primary"
    expand-on-hover
    :mini-variant="miniVariant"
    right
    absolute
    dark
    permanent
  >
    <v-list dense nav class="pt-0 transparent">
      <v-list-item two-line :class="miniVariant && 'px-0 mb-0'">
        <v-list-item-avatar>
          <img src="https://randomuser.me/api/portraits/men/81.jpg" />
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title>{{ GET_USER.name }}</v-list-item-title>
          <v-list-item-subtitle>{{ GET_USER.role }}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <div class="text-center mb-3">
        <v-btn @click.once="logout()" color="accent lighten-2" outlined>Logout</v-btn>
      </div>

      <v-divider></v-divider>

      <v-list-item v-for="item in items" :key="item.title" link>
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <router-link
            class="white--text subtitle-2"
            style="text-decoration: none;"
            :to="{ name: item.href }"
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
    drawer: false,
    miniVariant: true
  }),
  computed: {
    ...mapGetters(["GET_USER", "GET_PROFILE_LINKS"]),
    items: {
      get() {
        return this.$store.getters.GET_PROFILE_LINKS;
      },
      set() {}
    }
  },
  methods: {
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
  }
};
</script>

<style scoped>
.a {
  text-decoration: none;
  color: white;
}
</style>