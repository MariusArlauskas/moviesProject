<template>
  <v-card
    class="mainContainer transparent"
    style="margin-top: 25px"
    height="100%"
    width="100%"
    flat
    dark
  >
    <ProfileMoviesFilter />
    <v-layout style="margin-left: 15%" row>
      <v-card width="80%" class="transparent" flat>
        <v-layout row>
          <v-flex>a</v-flex>
        </v-layout>
      </v-card>
    </v-layout>
  </v-card>
</template>

<script>
import ProfileMoviesFilter from "./ProfileMoviesFilter";
export default {
  name: "ProfileMoviesList",
  components: { ProfileMoviesFilter }
};
</script>

<style scoped>
.oneRow {
  width: 100%;
}
</style>