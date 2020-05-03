<template>
  <v-layout class="mainContainer">
    <MovieFeed />
  </v-layout>
</template>

<script>
import MovieFeed from "./MovieFeed";
export default {
  name: "MovieMainWall",
  components: { MovieFeed }
};
</script>

<style scoped>
</style>