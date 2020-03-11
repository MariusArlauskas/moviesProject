<template>
  <div>
    <MoviesFilter />
    <v-layout class="mainContainer mt-3" wrap justify-center>
      <MovieCard v-for="item in items" :key="item.id" :item="item" />
    </v-layout>
    <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    <router-view name="MovieDialog"></router-view>
  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import MoviesFilter from "./MoviesFilter";
import { mapGetters } from "vuex";
import MovieCard from "./MovieCard";
export default {
  name: "Movies",
  components: { MovieCard, InfiniteLoading, MoviesFilter },
  data: () => ({
    pagesLoaded: 0,
    totalPages: 0
  }),
  methods: {
    getMovies() {
      this.pagesLoaded += 1;
      this.$store.dispatch("GET_MOVIES", this.pagesLoaded);
    },
    infiniteHandler($state) {
      setTimeout(() => {
        if (this.pagesLoaded == this.totalPages) {
          $state.complete();
        } else {
          $state.loaded();
          this.getMovies();
        }
      }, 1000);
    }
  },
  computed: {
    ...mapGetters(["GET_MOVIES"]),
    items: {
      get() {
        return this.$store.getters.GET_MOVIES;
      },
      set() {}
    }
  },
  beforeMount() {
    this.pagesLoaded = 0;
    this.getMovies();
    this.totalPages = this.$store.getters.GET_TOTAL_PAGES;
  }
};
</script>

<style scoped>
</style>