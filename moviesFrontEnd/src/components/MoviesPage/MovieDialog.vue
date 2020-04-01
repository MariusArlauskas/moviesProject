<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-flex style="width:40%; cursor:pointer" v-ripple v-on="on">
        <v-img height="100%" :src="movie.posterPath"></v-img>
      </v-flex>
    </template>
    <v-container
      style="position:absolute; min-width:190px; width: 13%; height:35.5%; left:24%; top: 12%"
    >
      <v-card flat style="background-color:var(--v-secondary-base);  height:100%;"></v-card>
    </v-container>
    <v-card
      dark
      width="40%"
      color="secondary lighten-1"
      style="position:absolute; left: 30%; top: 28.5%"
    >
      <v-card-title class="headline lighten-2" style="padding-left:15%" primary-title>
        <span style="max-height:30px; max-width: 68%; overflow: hidden">{{ movie.title }}</span>
        <v-col
          style="width:100px; max-width:150px; min-width:150px"
          class="py-0 pr-0 pl-10 ml-auto"
        >Score: {{ movie.rating }}</v-col>
        <v-col class="colorIndicator" :style="'background:' + getColor(movie.rating)"></v-col>
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
    <v-container style="position:absolute; max-width: 10%; width:10%; left:30%; top: 15%">
      <v-img
        id="pic"
        style="position:relative; min-width:114px; left: -50%"
        :src="movie.posterPath"
      ></v-img>
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
  }),
  methods: {
    getColor(value) {
      //value from 0 to 1
      var hue = ((0 + value / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,45%)"].join("");
    }
  }
};
</script>

<style scoped>
.search {
  margin-right: 15%;
}
.colorIndicator {
  border-top-right-radius: 4px;
  margin: -16px -24px -10px 20px;
  padding: 0;
  max-width: 8px;
  width: 8px;
  height: 80px;
}
</style>