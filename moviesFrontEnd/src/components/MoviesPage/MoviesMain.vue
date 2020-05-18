<template>
  <div>
    <MoviesFilter @clicked="onChangeFilter" />
    <v-layout class="mainContainer pl-10 mt-3" wrap justify-center>
      <MovieCard
        v-for="item in this.movies"
        :key="item.id"
        :item="item"
        :moviesAddTypes="moviesAddTypes"
      />
    </v-layout>
    <v-progress-circular
      v-show="!this.pagesEnd"
      v-if="typeof this.movies[0] == 'undefined' && this.movies[0] == null"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left:calc(50% - 15px); margin-top:2%"
    ></v-progress-circular>
    <infinite-loading
      ref="infiniteHandler"
      v-show="!this.pagesEnd"
      v-else
      spinner="spiral"
      @infinite="infiniteHandler"
    ></infinite-loading>
    <v-flex
      v-show="this.pagesEnd"
      class="mt-3 pb-5 ml-10 text-center grey--text body-2"
    >No more movies found</v-flex>
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
    lastFilter: "mostPopular",
    movies: [],
    moviesAddTypes: {}
  }),
  methods: {
    onChangeStuff(filterType) {
      this.movies = [];
      this.onChangeFilter(filterType, []);
    },
    onChangeFilter(filterType) {
      this.pagesEnd = false;
      this.pagesLoaded = 1;
      this.movies = [];
      this.lastFilter = filterType;
      this.getMovies(filterType[0].sort, filterType);
    },
    getMovies(type, onChangeFilter = {}) {
      this.$store
        .dispatch("GET_MOVIES", {
          page: this.pagesLoaded,
          userId: this.$store.getters.GET_USER.id,
          type: type,
          filter: onChangeFilter
        })
        .then(data => {
          if (typeof data[0] == "undefined" || data.length < 0) {
            this.pagesEnd = true;
            return;
          }
          this.movies = [...this.movies, ...data];
          this.pagesLoaded += 1;
        })
        .catch(() => {
          this.pagesEnd = true;
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "No movies found. Please change filter or refresh page!",
            alertClass: "error"
          });
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
          if (this.lastFilter[0].length != 0) {
            this.getMovies(this.lastFilter[0].sort, this.lastFilter);
          } else {
            this.getMovies("mostPopular");
          }
        }
      }, 1500);
    }
  },
  mounted() {
    this.pagesLoaded = 1;
    this.getMovieAddTypes();
    this.getMovies("mostPopular");
  }
};
</script>

<style scoped>
</style>