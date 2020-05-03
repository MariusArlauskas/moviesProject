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
      v-if="typeof this.movies[0] == 'undefined' && this.movies[0] == null && !this.noFilter"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left:calc(56% - 15px); margin-top:1.5%"
    ></v-progress-circular>
    <div v-show="!this.noData" v-else>
      <ProfileMoviesFilter :moviesAddTypes="addAllType()" @changed="onChangeFilter" />
      <v-layout
        v-if="!this.noFilter"
        :style="[this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl ? 'margin-left: 15%; max-width:85%' : ''] + ''"
        row
      >
        <v-card class="secondary px-3 pb-3" width="100%" flat>
          <v-flex class="pl-3 pt-2 title font-weight-medium">{{ shownMovies }}</v-flex>
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
    <v-flex
      v-show="this.noData || this.noFilter"
      class="mt-3 pt-5 text-center grey--text body-2"
    >No movies in list</v-flex>
  </v-card>
</template>

<script>
import ListItem from "./ListItem";
import ProfileMoviesFilter from "./ProfileMoviesFilter";
export default {
  name: "ProfileMoviesList",
  components: { ProfileMoviesFilter, ListItem },
  data: () => ({
    shownMovies: "Full movie list",
    movies: [],
    fullMoviesList: [],
    moviesAddTypes: [],
    noData: false,
    noFilter: false
  }),
  methods: {
    addAllType() {
      var temp = this.moviesAddTypes;
      temp[0] = "All";
      return temp;
    },
    onChangeFilter(filterType) {
      filterType.forEach(element => {
        switch (element.name) {
          case "type":
            if (element.sort == "All") {
              this.shownMovies = "Full movie list";
              this.movies = this.fullMoviesList;
            } else {
              this.shownMovies = element.sort;
              this.movies = this.fullMoviesList.filter(obj => {
                return this.moviesAddTypes[obj.relationTypeId] == element.sort;
              });
            }
            break;

          case "personalRating":
            this.movies = this.movies.filter(obj => {
              return (
                obj.userRating >= element.sort[0] &&
                obj.userRating <= element.sort[1] && [
                  element.sort[0] == 0 ? obj.userRating == null : true
                ]
              );
            });
            break;

          case "like":
            if (element.sort != "") {
              this.movies = this.movies.filter(obj => {
                return obj.isFavorite == element.sort;
              });
            }
            break;
        }
      });
      this.movies = this.movies.sort((a, b) => (a.title > b.title ? 1 : -1));
      if (this.movies.length == 0) {
        this.noFilter = true;
      } else {
        this.noFilter = false;
      }
    },
    getMovies() {
      this.$store
        .dispatch("GET_USER_MOVIES_LIST", this.$route.params.id)
        .then(data => {
          if (data && data.constructor === Array) {
            this.movies = data;
            this.fullMoviesList = data;
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