<template>
  <v-layout class="mainConteiner mt-8" wrap>
    <MovieCard />
    <MovieCard />
    <MovieCard />
    <MovieCard />
    <MovieCard />
  </v-layout>
</template>

<script>
import MovieCard from "./MovieCard";
export default {
  name: "MoviesPage",
  components: { MovieCard }
};
</script>

<style scoped>
</style>