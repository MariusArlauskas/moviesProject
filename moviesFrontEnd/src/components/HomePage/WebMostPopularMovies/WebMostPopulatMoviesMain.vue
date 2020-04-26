<template>
  <v-card class="transparent" width="100%" height="auto" flat dark>
    <v-progress-circular
      v-show="!this.noData"
      v-if="typeof this.movies[0] == 'undefined' && this.movies[0] == null"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left:calc(50% - 15px); margin-top:6%"
    ></v-progress-circular>
    <div v-show="!noData" v-else v-for="(movies, index) in this.movies" :key="index">
      <v-layout class="mx-0" style="width:100%" row>
        <v-card class="transparent px-3 pb-3" width="100%" flat>
          <v-flex class="pl-2 py-2 font-weight-light">
            Most
            <span class="accent--text text--lighten-2">popular</span>
            on site (last 30 days)
          </v-flex>
          <v-container class="py-0 px-0" v-for="(item, index2) in movies" :key="item.id">
            <WebMostPopulatListItem
              :item="item"
              :moviesAddTypes="moviesAddTypes"
              :popularity="movies[0].webPopularity"
            />
            <v-divider v-if="index2 != Object.keys(movies).length - 1"></v-divider>
          </v-container>
        </v-card>
      </v-layout>
    </div>
    <v-flex v-show="this.noData" class="mt-3 pt-5 text-center grey--text body-2">No popular movies</v-flex>
  </v-card>
</template>

<script>
import WebMostPopulatListItem from "./WebMostPopulatListItem";
export default {
  name: "WebMostPopularMoviesMain",
  components: { WebMostPopulatListItem },
  data: () => ({
    movies: [],
    moviesAddTypes: {},
    noData: false
  }),
  props: {
    userId: null
  },
  methods: {
    getMovies() {
      var uid = 0;
      if (typeof this.userId != "undefined" || this.userId != null) {
        uid = this.userId;
      }
      this.$store
        .dispatch("GET_WEB_MOST_POPULAR_MOVIES_LIST", { page: 1, userId: uid })
        .then(data => {
          if (data && data.constructor === Array) {
            this.movies.push(data.slice(0, 5));
          } else {
            this.noData = true;
          }
        })
        .catch(() => {
          this.noData = true;
        });
    },
    getMovieAddTypes() {
      this.$store.dispatch("GET_MOVIES_ADD_TYPES").then(data => {
        var moviesAddTypesArray = [];
        data.forEach(element => {
          moviesAddTypesArray[element.id] = element.name;
        });
        this.moviesAddTypes = moviesAddTypesArray;
        this.getMovies();
      });
    }
  },
  mounted() {
    this.getMovieAddTypes();
  }
};
</script>

<style scoped>
</style>