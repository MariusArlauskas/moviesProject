<template>
  <div>
    <MoviesFilter />
    <v-layout class="mainContainer mt-3" wrap justify-center>
      <MovieCard
        v-for="item in this.movies"
        :key="item.id"
        :item="item"
        :moviesAddTypes="moviesAddTypes"
      />
    </v-layout>
    <infinite-loading spinner="spiral" @infinite="infiniteHandler"></infinite-loading>
    <router-view name="MovieDialog"></router-view>
  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import MoviesFilter from "./MoviesFilter";
import MovieCard from "./MovieCard";
export default {
  name: "Movies",
  components: { MovieCard, InfiniteLoading, MoviesFilter },
  data: () => ({
    pagesEnd: false,
    pagesLoaded: 1,
    movies: [],
    moviesAddTypes: {}
  }),
  methods: {
    getMovies() {
      this.$store
        .dispatch("GET_MOVIES", {
          page: this.pagesLoaded,
          userId: this.$store.getters.GET_USER.id
        })
        .then(data => {
          this.pagesLoaded += 1;
          this.movies = [...this.movies, ...data];
        })
        .catch(() => {
          this.pagesEnd = true;
        });
    },
    getMovieAddTypes() {
      this.$store.dispatch("GET_MOVIES_ADD_TYPES").then(data => {
        var moviesAddTypesArray = [];
        moviesAddTypesArray[0] = "Remove";
        data.forEach(element => {
          moviesAddTypesArray[element.id] = element.name;
        });
        this.moviesAddTypes = moviesAddTypesArray;
      });
    },
    infiniteHandler($state) {
      setTimeout(() => {
        if (this.pagesEnd) {
          $state.complete();
        } else {
          $state.loaded();
          this.getMovies();
        }
      }, 1500);
    }
  },
  mounted() {
    this.pagesLoaded = 1;
    this.getMovies();
    this.getMovieAddTypes();
  }
};
</script>

<style scoped>
</style>