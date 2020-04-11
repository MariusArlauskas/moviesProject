<template>
  <v-card
    class="mainContainer transparent"
    style="margin-top: 25px; margin-bottom: 25px"
    width="100%"
    height="auto"
    flat
    dark
  >
    <ProfileMoviesFilter />
    <v-layout style="margin-left: 12%; width:88%" row>
      <v-card class="secondary px-3 py-3" width="100%" flat>
        <v-container class="py-0 px-0" v-for="(item, index) in this.movies" :key="item.id">
          <ListItem :item="item" :moviesAddTypes="moviesAddTypes" />
          <v-divider v-if="index != Object.keys(movies).length - 1"></v-divider>
        </v-container>
      </v-card>
    </v-layout>
  </v-card>
</template>

<script>
import ListItem from "./ListItem";
import ProfileMoviesFilter from "./ProfileMoviesFilter";
export default {
  name: "ProfileMoviesList",
  components: { ProfileMoviesFilter, ListItem },
  data: () => ({
    movies: [],
    moviesAddTypes: {}
  }),
  methods: {
    getMovies() {
      this.$store
        .dispatch("GET_USER_MOVIES_LIST", this.$store.getters.GET_USER.id)
        .then(data => {
          this.movies = [...this.movies, ...data];
        })
        .catch(() => {});
    },
    getMovieAddTypes() {
      this.$store.dispatch("GET_MOVIES_ADD_TYPES").then(data => {
        var moviesAddTypesArray = [];
        data.forEach(element => {
          moviesAddTypesArray[element.id] = element.name;
        });
        this.moviesAddTypes = moviesAddTypesArray;
      });
    }
  },
  mounted() {
    this.getMovies();
    this.getMovieAddTypes();
  }
};
</script>

<style scoped>
.oneRow {
  width: 100%;
}
</style>