<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-flex style="width:40%; cursor:pointer" v-ripple v-on="on">
        <v-img height="100%" :src="movie.posterPath"></v-img>
      </v-flex>
    </template>
    <v-container style="position:absolute; width: 13%; height:35.5%; left:24%; top: 12%">
      <!-- <v-img
        style="position:relative; left: -50%"
        :src="'https://image.tmdb.org/t/p/w600_and_h900_bestv2/'+movie.poster_path"
      ></v-img>-->
      <v-card flat style="background-color:var(--v-secondary-base);  height:100%;">
        <!-- <v-img contain width="100%" src="../../assets/bgpic.jpg"></v-img> -->
      </v-card>
    </v-container>
    <v-card
      dark
      width="40%"
      color="secondary lighten-1"
      style="position:absolute; left: 30%; top: 28.5%"
    >
      <v-card-title class="headline lighten-2" style="padding-left:15%" primary-title>
        {{ movie.title }}
        <v-spacer></v-spacer>
        Score (TODO color): {{ movie.voteAverage }}
      </v-card-title>
      <v-divider></v-divider>

      <v-layout column style="padding-left:15%; width: 90%">
        <v-flex class="pt-5">
          <strong>Original title:</strong>
          {{ movie.originalTitle }}
        </v-flex>
        <v-flex class="font-weight-light">{{ movie.genres.join(', ') }}</v-flex>
        <v-flex></v-flex>
        <v-card-text>
          <v-row class="pb-1" style="font-family: 'Courgette', cursive;">{{ movie.overview }}</v-row>
        </v-card-text>
      </v-layout>

      <v-divider></v-divider>

      <v-card-actions>
        <v-btn text @click="showDialog = false">Back</v-btn>
        <v-spacer></v-spacer>
        <v-btn text @click="showDialog = false">Open movie</v-btn>
      </v-card-actions>
    </v-card>
    <v-container style="position:absolute; max-width: 10%; left:30%; top: 15%">
      <v-img style="position:relative; left: -50%" :src="movie.posterPath"></v-img>
    </v-container>
  </v-dialog>
</template>

<script>
export default {
  name: "MovieDialog2",
  props: {
    movie: Object
  },
  data: () => ({
    dialog: false
  })
};
</script>

<style scoped>
.search {
  margin-right: 15%;
}
</style>