<template>
  <v-flex class="mx-0 px-0" style="margin-top: -9px; width:100">
    <MovieInfoRow />
    <v-divider class="secondary lighten-1"></v-divider>
    <v-tabs background-color="secondary" dark>
      <v-tab :to="{name: 'MovieMainWall'}" :router="true" class="tab font-weight-thin">Main</v-tab>
    </v-tabs>
    <router-view />
  </v-flex>
</template>

<script>
import MovieInfoRow from "./MovieInfoRow";
export default {
  name: "MoviePage",
  components: { MovieInfoRow }
};
</script>

<style scoped>
.tab {
  margin-left: 10%;
}
</style>