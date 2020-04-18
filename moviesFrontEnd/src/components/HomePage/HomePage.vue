<template>
  <v-layout row class="mainContainer mt-3" style="width:100%; height:auto">
    <v-card class="leftColumn" color="transparent" dark outlined>s</v-card>
    <v-card class="middleColumn" color="transparent" dark flat>
      <FeedMain />
    </v-card>
    <v-card class="rightColumn" color="transparent" dark outlined>
      <MyMoviesMain :userId="getUser().id" v-if="getUser().id > 0" />
    </v-card>
  </v-layout>
</template>

<script>
import MyMoviesMain from "./MyMovies/MyMoviesMain";
import FeedMain from "./Feed/FeedMain";
export default {
  name: "HomePage",
  components: { FeedMain, MyMoviesMain },
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
