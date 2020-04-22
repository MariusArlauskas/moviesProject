<template>
  <v-flex class="mx-0 px-0" style="margin-top: -9px; width:100">
    <MovieInfoRow />
    <v-divider class="secondary lighten-1"></v-divider>
    <!-- <v-tabs background-color="secondary" dark>
      <v-tab :to="{name: 'ProfileMainWall'}" :router="true" class="tab font-weight-thin">Main</v-tab>
      <v-tab :to="{name: 'ProfileMoviesList'}" :router="true" class="font-weight-thin">Movies</v-tab>
    </v-tabs>
    <router-view />-->
  </v-flex>
</template>

<script>
import MovieInfoRow from "./MovieInfoRow";
export default {
  name: "MoviePage",
  components: { MovieInfoRow }
};
</script>

<style>
</style>