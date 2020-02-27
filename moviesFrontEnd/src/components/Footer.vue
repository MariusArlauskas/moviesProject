<template>
  <nav>
    <v-toolbar height="auto" bottom dark color="var(--v-primary-base)">
      <v-row justify="center">
        <p class="my-0 font-weight-light overline">&copy;2020 {{ getWebTitle }}</p>
      </v-row>
    </v-toolbar>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Footer",
  computed: {
    ...mapGetters(["getWebTitle"])
  }
};
</script>

<style scoped></style>
