<template>
  <v-layout class="mainConteiner mt-8" wrap justify-center>
    <MovieCard v-for="item in items" :key="item.id" :id="item.id" />
  </v-layout>
</template>

<script>
import MovieCard from "./MovieCard";
export default {
  name: "MoviesPage",
  data() {
    return {
      items: [
        { id: 0, title: "sup" },
        { id: 1, title: "sup" },
        { id: 2, title: "sup" },
        { id: 3, title: "sup" },
        { id: 4, title: "sup" },
        { id: 5, title: "sup" },
        { id: 6, title: "sup" },
        { id: 7, title: "sup" },
        { id: 8, title: "sup" },
        { id: 9, title: "sup" },
        { id: 10, title: "sup" },
        { id: 11, title: "sup" }
      ]
    };
  },
  components: { MovieCard }
};
</script>

<style scoped>
</style>