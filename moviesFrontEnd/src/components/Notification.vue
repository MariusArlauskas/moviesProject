<template>
  <v-snackbar
    :color="NOTIFICATION.class"
    v-model="snackbar"
    bottom
    right
    :timeout="NOTIFICATION.timeout"
  >
    <v-icon dark>notification_important</v-icon>
    <v-col class="white--text">{{ NOTIFICATION.text }}</v-col>
    <v-btn text dark @click.prevent="snackbar = false">
      <v-icon>clear</v-icon>
    </v-btn>
  </v-snackbar>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "notification",
  computed: {
    ...mapGetters(["NOTIFICATION"]),
    snackbar: {
      get() {
        return this.$store.getters.NOTIFICATION.display;
      },
      set() {
        this.$store.commit("SET_NOTIFICATION", {
          display: false
        });
      }
    }
  }
};
</script>

<style scoped>
</style>