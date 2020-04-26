<template>
  <v-layout
    class="fullRow caption font-weight-light mx-0"
    align-center
    style="height: 50px; width:100%; cursor:pointer"
    row
    @click="$refs.movieDialog.dialog = true"
  >
    <v-flex
      ref="movieImage"
      style="height:40px; margin-left: 10px; max-width: 40px; min-width:40px"
    >
      <MovieDialog ref="movieDialog" :movie="this.item" :moviesAddTypes="sendMoviesAddTypes()" />
    </v-flex>
    <v-col
      class="text-no-wrap"
      style="margin-left:1%; max-width:35%; min-width:35%; overflow-x: hidden"
    >{{ this.item.title }}</v-col>
    <v-card
      class="py-1 px-0 accent--text text--lighten-3"
      flat
      :color="getColor()"
      :style="'margin-left: 10%; max-width:' + getWidth() +'%; min-width:' + getWidth() +'%;'"
    ></v-card>
  </v-layout>
</template>

<script>
import MovieDialog from "./../../MoviesPage/MovieDialog";
export default {
  name: "WebMostPopularListItem",
  components: { MovieDialog },
  data: () => ({}),
  props: {
    item: Object,
    moviesAddTypes: null,
    popularity: null
  },
  methods: {
    getWidth() {
      return (23 / this.popularity) * this.item.webPopularity;
    },
    getColor() {
      var value = (10 / this.popularity) * this.item.webPopularity;
      //value from 0 to 1
      var hue = ((0 + (value - 1) / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,40%)"].join("");
    },
    sendMoviesAddTypes() {
      var temp = this.moviesAddTypes;
      temp[0] = "Remove";
      return temp;
    }
  }
};
</script>

<style scoped>
.fullRow {
  width: 100%;
}
.fullRow:hover {
  background-color: var(--v-background-lighten1);
}
</style>