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
    movies: [],
    lastFilter: [],
    moviesAddTypes: {},
    going: false
  }),
  methods: {
    onChangeStuff(filterType) {
      this.movies = [];
      this.onChangeFilter(filterType, []);
    },
    onChangeFilter(filterType, data) {
      console.log(filterType);
      if (filterType == "") {
        if (this.lastFilter.length != 0) {
          filterType = this.lastFilter;
        }
      }
      if (typeof data == "undefined" || data.length == 0) {
        this.movies = [];
        this.pagesLoaded = 1;
        this.pagesEnd = false;
        this.lastFilter = filterType;
        this.getMovies(filterType[0].sort);
        return;
      }

      if (filterType.length != 0) {
        filterType.forEach(element => {
          switch (element.name) {
            case "type":
              break;

            case "genre":
              if (element.sort.length == 0) {
                break;
              }
              data = data.filter(obj => {
                if (obj.genres.indexOf(",") > -1) {
                  var temp = obj.genres.split(", ");
                  var ans = true;
                  element.sort.forEach(el => {
                    if (!temp.includes(el)) {
                      ans = false;
                      return;
                    }
                  });
                  return ans;
                } else {
                  if (
                    element.sort.length == 1 &&
                    element.sort[0] == obj.genres
                  ) {
                    return true;
                  }
                  return false;
                }
              });
              break;

            case "like":
              console.log("try");
              console.log(element.sort);
              if (element.sort != "") {
                console.log("in");
                data = data.filter(obj => {
                  if (element.sort == 1) {
                    return obj.isFavorite != null && obj.isFavorite > 0;
                  } else {
                    return obj.isFavorite == null || obj.isFavorite == 0;
                  }
                });
              }
              break;

            case "list":
              if (element.sort != "") {
                data = data.filter(obj => {
                  if (element.sort == 1) {
                    return obj.relationTypeId != null && obj.relationTypeId > 0;
                  } else {
                    return (
                      obj.relationTypeId == null || obj.relationTypeId == 0
                    );
                  }
                });
              }
              break;

            case "year":
              data = data.filter(obj => {
                if (
                  typeof obj.releaseDate != "undefined" &&
                  obj.releaseDate != null &&
                  obj.releaseDate != ""
                ) {
                  var releaseDate = new Date(obj.releaseDate);
                  var date1 = new Date(element.sort[0] + "-01-01");
                  var date2 = new Date(element.sort[1] + "-01-01");
                  return releaseDate >= date1 && releaseDate <= date2;
                } else {
                  if (element.sort[0] == "1900") {
                    return true;
                  }
                }
              });
              break;
          }
        });
      }
      if (data.length == 0) {
        if (this.lastFilter[0].length != 0) {
          this.getMovies(this.lastFilter[0].sort);
        } else {
          this.getMovies("mostPopular");
        }
      } else {
        this.movies = [...this.movies, ...data];
      }
    },
    getMovies(type) {
      if (this.going) {
        return;
      }
      this.going = true;
      this.$store
        .dispatch("GET_MOVIES", {
          page: this.pagesLoaded,
          userId: this.$store.getters.GET_USER.id,
          type: type
        })
        .then(data => {
          if (typeof data[0] == "undefined" || data.length < 0) {
            this.pagesEnd = true;
            return;
          }
          if (data.length < 2) {
            this.pagesEnd = true;
          }
          this.pagesLoaded += 1;
          this.onChangeFilter("", data);
          this.going = false;
        })
        .catch(err => {
          console.log(err);
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
          if (this.lastFilter[0].length != 0) {
            this.getMovies(this.lastFilter[0].sort);
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