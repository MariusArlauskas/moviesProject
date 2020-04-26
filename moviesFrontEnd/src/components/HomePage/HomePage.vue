<template>
  <v-layout row class="mainContainer mt-3" style="width:100%; height:auto">
    <v-card
      v-if="this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
      class="leftColumn"
      color="transparent"
      dark
      outlined
    >
      <WebMostPopularMoviesMain :userId="getUser().id" />
    </v-card>

    <v-card
      :class="[this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl ? 'middleColumn' : '']"
      :style="[this.$vuetify.breakpoint.md ? 'width: 68%;' : [this.$vuetify.breakpoint.sm || this.$vuetify.breakpoint.xs ? 'width: 100%;' : '']] + ''"
      color="transparent"
      dark
      flat
    >
      <FeedMain />
    </v-card>

    <v-card
      v-if="!(this.$vuetify.breakpoint.sm || this.$vuetify.breakpoint.xs)"
      class="rightColumn"
      color="transparent"
      dark
      outlined
    >
      <MyMoviesMain v-if="getUser().id > 0" :userId="getUser().id" />
      <v-card v-else class="transparent" width="100%" height="auto" flat dark>
        <v-flex class="pt-5 caption text-center grey--text body-2">
          Login to see
          <span class="accent--text text--lighten-2">your movies</span> menu
        </v-flex>
      </v-card>
    </v-card>
  </v-layout>
</template>

<script>
import WebMostPopularMoviesMain from "./WebMostPopularMovies/WebMostPopulatMoviesMain";
import FeedMain from "./Feed/FeedMain";
import MyMoviesMain from "./MyMovies/MyMoviesMain";
export default {
  name: "HomePage",
  components: { FeedMain, MyMoviesMain, WebMostPopularMoviesMain },
  computed: {
    getClass() {
      return this.$route.name === "HomePage" ? "layoutMain" : "layoutSide";
    },
    theme() {
      return this.$vuetify.theme.dark ? "dark" : "light";
    }
  },
  methods: {
    getUser() {
      return this.$store.getters.GET_USER;
    }
  }
};
</script>

<style scoped>
.leftColumn {
  width: 20%;
  margin-left: 0;
}
.middleColumn {
  width: 46%;
  margin-left: 2%;
}
.rightColumn {
  width: 30%;
  margin-left: 2%;
}
</style>
