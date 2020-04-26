<template>
  <v-layout
    class="fullRow caption font-weight-light mx-0"
    align-center
    style="height: 50px; cursor:pointer"
    row
    @click="$refs.movieDialog.dialog = true"
    @mouseover="$refs.movieImage.style = 'height:180px; margin-left: -50px; max-width: 120px; margin-top: -138px'"
    @mouseleave="$refs.movieImage.style = 'height:40px; margin-left: 30px; max-width: 40px'"
  >
    <v-flex
      ref="movieImage"
      style="height:40px; margin-left: 30px; max-width: 40px; min-width:40px"
    >
      <MovieDialog ref="movieDialog" :movie="this.item" :moviesAddTypes="sendMoviesAddTypes()" />
      <!-- <v-img contain height="100%" :src="this.item.posterPath"></v-img> -->
    </v-flex>
    <v-col
      v-show="this.$vuetify.breakpoint.sm || this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
      class="text-no-wrap"
      style="margin-left:1%; max-width:45%; min-width:20%; overflow-x: hidden"
    >{{ this.item.title }}</v-col>
    <v-icon
      v-show="this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
      style="margin-left: 4%; max-width: 30px; min-width:30px"
      color="accent lighten-2"
      size="23"
      v-if="this.item.isFavorite == 1"
    >{{ this.likeIcon }}</v-icon>
    <v-icon
      v-show="this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
      style="margin-left: 4%; max-width: 30px; min-width:30px"
      color="accent lighten-2"
      size="23"
      v-else
    >{{ this.nolikeIcon }}</v-icon>
    <v-col
      style="margin-left: 5%; max-width:90px; min-width:90px"
      v-if="typeof this.moviesAddTypes[this.item.relationTypeId] !== 'undefined' && this.moviesAddTypes[this.item.relationTypeId] !== null && this.moviesAddTypes[this.item.relationTypeId] !== '' && this.item.relationTypeId != 0"
    >{{ this.moviesAddTypes[this.item.relationTypeId] }}</v-col>
    <v-col v-else style="margin-left: 5%; max-width:90px; min-width:90px"></v-col>
    <v-col
      v-show="this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
      style="margin-left: auto; max-width:55px; min-width:55px"
    >{{ this.item.rating }}</v-col>
    <v-container
      v-show="this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl"
      class="colorIndicator"
      :style="'margin-right:1%; background:' + getColor(item.rating)"
    ></v-container>
    <v-col
      v-if="typeof item.userRating !== 'undefined' && item.userRating !== null && item.userRating != '' && item.userRating != 0"
      style="margin-left: auto; max-width:40px; min-width:40px"
    >{{ this.item.userRating }}</v-col>
    <v-col v-else style="margin-left: auto; max-width:40px; min-width: 40px"></v-col>
    <v-container
      v-if="typeof item.userRating !== 'undefined' && item.userRating !== null && item.userRating != '' && item.userRating != 0"
      class="colorIndicator"
      :style="'margin-right:4%; background:' + getColor(item.userRating)"
    ></v-container>
    <v-container
      v-else
      style="margin-left:0px; margin-right:4%; max-width:20px; min-width:20px; padding:2px"
    ></v-container>
  </v-layout>
</template>

<script>
import MovieDialog from "./../../MoviesPage/MovieDialog";
export default {
  name: "ListItem",
  components: { MovieDialog },
  data: () => ({
    nolikeIcon: "mdi-heart-outline",
    likeIcon: "mdi-heart"
  }),
  props: {
    item: Object,
    moviesAddTypes: null
  },
  methods: {
    getColor(value) {
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
.colorIndicator {
  border-radius: 50%;
  padding: 2px;
  margin: 0px;
  width: 20px;
  height: 20px;
}
</style>