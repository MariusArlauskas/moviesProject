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
            Movies I'm
            <span class="accent--text text--lighten-2">{{ names[index] }}</span>
          </v-flex>
          <v-container class="py-0 px-0" v-for="(item, index2) in movies" :key="item.id">
            <ListItem :item="item" :moviesAddTypes="moviesAddTypes" />
            <v-divider v-if="index2 != Object.keys(movies).length - 1"></v-divider>
          </v-container>
        </v-card>
      </v-layout>
    </div>
    <v-flex
      v-show="this.noData"
      class="mt-3 pt-5 text-center grey--text body-2"
    >You are not planning to watch any new movies</v-flex>
  </v-card>
</template>

<script>
import ListItem from "./ListItem";
export default {
  name: "MyMoviesMain",
  components: { ListItem },
  data: () => ({
    names: ["watching", "planning"],
    movies: [],
    moviesAddTypes: {},
    noData: false
  }),
  props: {
    userId: null
  },
  methods: {
    getMovies() {
      this.$store
        .dispatch("GET_USER_MOVIES_LIST", this.userId)
        .then(data => {
          if (data && data.constructor === Array) {
            let first = data
              .filter(obj => {
                return this.moviesAddTypes[obj.relationTypeId] == "Watching";
              })
              .sort((a, b) => (a.title > b.title ? 1 : -1))
              .slice(0, 5);

            let second = data
              .filter(obj => {
                return this.moviesAddTypes[obj.relationTypeId] == "Planning";
              })
              .sort((a, b) => (a.title > b.title ? 1 : -1))
              .slice(0, 5);

            this.movies.push(first);
            this.movies.push(second);
          } else {
            this.noData = true;
          }
        })
        .catch(() => {});
    },
    async getMovieAddTypes() {
      await this.$store.dispatch("GET_MOVIES_ADD_TYPES").then(data => {
        var moviesAddTypesArray = [];
        data.forEach(element => {
          moviesAddTypesArray[element.id] = element.name;
        });
        this.moviesAddTypes = moviesAddTypesArray;
        this.getMovies();
      });
    }
  },
  created() {
    this.getMovieAddTypes();
  }
};
</script>

<style scoped>
</style>