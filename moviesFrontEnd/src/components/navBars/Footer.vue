<template>
  <v-footer height="45px" bottom dark color="var(--v-primary-base)">
    <v-row justify="center">
      <p class="my-0 font-weight-light overline">&copy;2020 {{ GET_WEB_TITLE }}</p>
    </v-row>
  </v-footer>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Footer",
  computed: {
    ...mapGetters(["GET_WEB_TITLE"])
  }
};
</script>

<style scoped></style>
