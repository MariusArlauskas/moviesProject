<template>
  <div>
    <MoviesFilter />
    <v-layout class="mainContainer mt-3" wrap justify-center>
      <MovieCard v-for="item in this.movies" :key="item.id" :item="item" />
    </v-layout>
    <infinite-loading @infinite="infiniteHandler"></infinite-loading>
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
    movies: []
  }),
  methods: {
    async getMovies() {
      await this.$store
        .dispatch("GET_MOVIES", this.pagesLoaded)
        .then(data => {
          this.pagesLoaded += 1;
          this.movies = [...this.movies, ...data];
        })
        .catch(() => {
          this.pagesEnd = true;
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
  computed: {},
  beforeMount() {
    this.pagesLoaded = 1;
    this.getMovies();
  }
};
</script>

<style scoped>
</style>