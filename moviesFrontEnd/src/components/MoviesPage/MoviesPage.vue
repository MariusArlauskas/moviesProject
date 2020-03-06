<template>
  <v-layout class="mainConteiner mt-8" wrap justify-center>
    <MovieCard v-for="item in items" :key="item.id" :item="item" />
  </v-layout>
</template>

<script>
import { mapGetters } from "vuex";
import MovieCard from "./MovieCard";
export default {
  name: "MoviesPage",
  components: { MovieCard },
  data: () => ({}),
  methods: {
    getMovies() {
      this.$store.dispatch("GET_MOVIES");
    }
  },
  computed: {
    ...mapGetters(["GET_MOVIES"]),
    items: {
      get() {
        return this.$store.getters.GET_MOVIES;
      },
      set() {}
    }
  },
  beforeMount() {
    this.getMovies();
  }
};
</script>

<style scoped>
</style>