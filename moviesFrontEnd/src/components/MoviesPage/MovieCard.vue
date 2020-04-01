<template>
  <v-card class="movieCard white--text mb-4" outlined dark>
    <v-card-title class="primary subtitle-1 py-0 text-no-wrap" style="height: 15%">
      <v-tooltip top>
        <template v-slot:activator="{ on }">
          <span
            style="max-width: 98%; overflow: hidden"
            class="font-weight-light"
            v-on="on"
          >{{ item.title }}</span>
        </template>
        <span style="overflow: hidden">{{ item.title }}</span>
      </v-tooltip>
      <v-container class="colorIndicator" :style="'background:' + getColor(item.rating)"></v-container>
    </v-card-title>
    <v-layout style="height:85%; width:100%">
      <MovieDialog :movie="item" />
      <v-flex outlined style="width:60%; height:100%">
        <v-card flat dark style="width:100%; height:36%; background:transparent">
          <v-row class="mx-0 pt-3 pl-4">
            <v-col class="px-0 py-0 font-italic font-weight-light white--text">{{ item.author }}</v-col>
            <v-col
              class="pl-0 py-0 font-italic font-weight-light white--text text-right"
            >{{ new Date (item.releaseDate.timestamp * 1000).toLocaleString().substring(0, 10) }}</v-col>
          </v-row>
          <v-row class="mx-0 pt-1 pl-4 caption">{{ item.genres.join(', ') }}</v-row>
        </v-card>

        <v-card-text
          class="desc white--text caption mt-4 pt-0 pl-4 pr-5"
          style="height:49%; overflow-y: scroll"
        >
          <div>{{ item.overview }}</div>
        </v-card-text>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
import MovieDialog from "./MovieDialog";
export default {
  name: "MovieCard",
  components: { MovieDialog },
  data: () => ({
    isActive: false
  }),
  props: {
    item: Object
  },
  methods: {
    openMovieDialog(movie) {
      this.$router.push({
        name: "MovieDialog",
        params: {
          movieId: movie.id,
          movie: movie
        }
      });
    },
    getColor(value) {
      //value from 0 to 1
      var hue = ((0 + (value - 1) / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,45%)"].join("");
    }
  }
};
</script>

<style scoped>
.movieCard {
  margin-left: 0.5%;
  margin-right: 0.5%;
  /* background: var(--v-secondary-lighten1); */
  background: transparent;
  max-width: 400px;
  max-height: 230px;
}
.bg {
  background: rgba(12, 16, 23, 0.5);
}
.desc::-webkit-scrollbar {
  display: none;
}
.colorIndicator {
  border-top-right-radius: 4px;
  padding: 2px;
  margin-right: -16px;
  margin-left: auto;
  width: 4px;
  height: 100%;
}
</style>