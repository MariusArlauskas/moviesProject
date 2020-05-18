<template>
  <v-card class="topContainer secondary" max-height="290px" min-height="290px" dark flat>
    <v-layout
      v-if="typeof this.movie != 'undefined' || this.movie != {}"
      justify-center
      row
      style="padding: 20px 120px 20px 7%; height:290px; width:100%"
    >
      <v-spacer></v-spacer>
      <v-card class="transparent" style="width: 15%" flat>
        <v-card-title class="font-weight-thin pb-0 px-0">Release date</v-card-title>
        <v-row class="mx-0">{{ this.movie.releaseDate }}</v-row>
        <v-card-title class="font-weight-thin py-0 px-0">Author</v-card-title>
        <v-row class="mx-0">{{ this.movie.author == null ? 'Unknown' : this.movie.author }}</v-row>
        <v-card-title class="font-weight-thin py-0 px-0">Rating</v-card-title>
        <v-row class="mx-0" align="center">
          {{ this.movie.rating }}
          <v-container
            v-if="typeof this.movie.rating !== 'undefined' && this.movie.rating !== null && this.movie.rating != '' && this.movie.rating != 0"
            class="colorIndicator"
            :style="'margin-left:10px; background:' + getColor(this.movie.rating)"
          ></v-container>
        </v-row>
      </v-card>
      <v-card img class="transparent" flat max-width="12%" max-height="100%" min-width="180px">
        <v-img contain max-height="100%" max-width="100%" :src="this.movie.posterPath"></v-img>
      </v-card>
      <v-spacer></v-spacer>
      <v-card class="py-0 transparent" style="min-width:553px; width: 65%; height: 100%" flat>
        <v-card-title
          class="font-italic font-weight-thin pb-4 pt-0"
          style="overflow-y: hidden"
        >{{ this.movie.originalTitle }}</v-card-title>
        <v-card-text
          class="desc"
          style="height: 80%; overflow-y: scroll; white-space: pre-line;"
        >{{ this.movie.overview }}</v-card-text>
      </v-card>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  name: "MovieInfoRow",
  data: () => ({
    movie: {}
  }),
  computed: {},
  methods: {
    getFullMovieInfo() {
      this.$store
        .dispatch("GET_FULL_MOVIE", this.$route.params.id)
        .then(data => {
          this.movie = data;
        });
    },
    getColor(value) {
      //value from 0 to 1
      var hue = ((0 + (value - 1) / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,40%)"].join("");
    }
  },
  beforeMount() {
    this.getFullMovieInfo();
  }
};
</script>

<style scoped>
.topContainer {
  width: 100%;
  border-radius: 0%;
  max-height: 35%;
  height: 35%;
}
.desc::-webkit-scrollbar {
  display: none;
}
.desc {
  scrollbar-width: none;
}
div a {
  text-decoration: none;
}
.colorIndicator {
  border-radius: 50%;
  padding: 2px;
  margin: 0px;
  width: 15px;
  height: 15px;
}
</style>