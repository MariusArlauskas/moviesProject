<template>
  <v-card
    class="mainContainer transparent"
    style="margin-top: 25px; margin-bottom: 25px"
    width="100%"
    height="auto"
    flat
    dark
  >
    <v-progress-circular
      v-show="!this.noData"
      v-if="typeof this.movies[0] == 'undefined' && this.movies[0] == null"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left:calc(56% - 15px); margin-top:1.5%"
    ></v-progress-circular>
    <div v-show="!this.noData" v-else>
      <ProfileMoviesFilter />
      <v-layout
        :style="[this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl ? 'margin-left: 12%; max-width:88%' : ''] + ''"
        row
      >
        <v-card class="secondary px-3 pb-3" width="100%" flat>
          <v-flex class="pl-3 pt-2 title font-weight-medium">Full movie list</v-flex>
          <v-layout class="mt-0 mb-5 listHeader" style="height: 35px" row>
            <v-col
              v-show="this.$vuetify.breakpoint.sm || this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
              class="px-0 text-center"
              style="margin-left:1%; max-width:calc(45% + 70px); min-width:calc(20% + 70px);"
            >Title</v-col>
            <v-col
              class="px-0 text-center"
              :style="[this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl ? 'margin-left: 5%; max-width: calc(120px + 4%); min-width:calc(120px + 4%);' : [this.$vuetify.breakpoint.xs ? 'margin-left: 30%; max-width: 90px; min-width:90px;' : 'margin-left: 5%; max-width: 90px; min-width:90px;']] + ''"
            >Status</v-col>
            <v-col
              v-show="this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
              class="px-0 text-center"
              style="margin-left: auto; max-width:calc(75px + 1%); min-width:calc(75px + 1%)"
            >Rating</v-col>
            <v-col
              class="px-0 text-center"
              style="margin-left: auto; max-width:calc(60px + 4%); min-width:calc(60px + 4%)"
            >My rating</v-col>
          </v-layout>
          <v-container class="py-0 px-0" v-for="(item, index) in this.movies" :key="item.id">
            <ListItem :item="item" :moviesAddTypes="moviesAddTypes" />
            <v-divider v-if="index != Object.keys(movies).length - 1"></v-divider>
          </v-container>
        </v-card>
      </v-layout>
    </div>
    <v-flex v-show="this.noData" class="mt-3 pt-5 text-center grey--text body-2">No movies in list</v-flex>
  </v-card>
</template>

<script>
import ListItem from "./ListItem";
import ProfileMoviesFilter from "./../ProfileMoviesFilter";
export default {
  name: "ProfileMoviesList",
  components: { ProfileMoviesFilter, ListItem },
  data: () => ({
    movies: [],
    moviesAddTypes: {},
    noData: false
  }),
  methods: {
    getMovies() {
      this.$store
        .dispatch("GET_USER_MOVIES_LIST", this.$route.params.id)
        .then(data => {
          if (data && data.constructor === Array) {
            this.movies = data;
          } else {
            this.noData = true;
          }
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
.listHeader {
  min-width: 100%;
  max-width: 100%;
  padding-right: -20px;
}
</style>