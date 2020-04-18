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
      style="margin-left:1%; max-width:45%; min-width:45%; overflow-x: hidden"
    >{{ this.item.title }}</v-col>
    <v-col
      class="accent--text text--lighten-3"
      style="margin-left: auto; margin-right: 2%; max-width:90px; min-width:90px"
      v-if="typeof this.moviesAddTypes[this.item.relationTypeId] !== 'undefined' && this.moviesAddTypes[this.item.relationTypeId] !== null && this.moviesAddTypes[this.item.relationTypeId] !== '' && this.item.relationTypeId != 0"
    >{{ this.moviesAddTypes[this.item.relationTypeId] }}</v-col>
  </v-layout>
</template>

<script>
import MovieDialog from "./../../MoviesPage/MovieDialog";
export default {
  name: "ListItem",
  components: { MovieDialog },
  data: () => ({}),
  props: {
    item: Object,
    moviesAddTypes: null
  },
  methods: {
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