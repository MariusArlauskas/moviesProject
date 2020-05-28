<template>
  <v-card
    class="body-2 font-weight-light white--text pt-2"
    style="max-width:15%; min-width: 200px; position: absolute"
    color="transparent"
    flat
    dark
  >
    <v-layout class="pr-5" style="margin-left:30%" wrap>
      <v-flex class="oneRow subtitle-1 text-center pb-3">Filter settings</v-flex>
      <v-flex class="oneRow">
        <v-select
          class="pb-2"
          v-model="selectType"
          :items="listTypes"
          item-text="name"
          item-value="value"
          hint="Sort by"
          persistent-hint
          dense
        ></v-select>
      </v-flex>
      <v-flex class="oneRow">
        <v-select
          class="pb-2"
          v-model="selectGenre"
          :items="genres"
          item-text="name"
          item-value="name"
          hint="Genre"
          persistent-hint
          dense
          multiple
        ></v-select>
      </v-flex>
      <v-flex v-if="GET_USER" class="oneRow">
        <v-select
          class="pb-2"
          v-model="selectLike"
          value="All"
          :items="likeTypes"
          item-text="name"
          item-value="value"
          hint="Favorite"
          persistent-hint
          dense
        ></v-select>
      </v-flex>
      <v-flex v-if="GET_USER" class="oneRow">
        <v-select
          class="pb-10"
          v-model="selectList"
          value="All"
          :items="inListTypes"
          item-text="name"
          item-value="value"
          hint="In list"
          persistent-hint
          dense
        ></v-select>
      </v-flex>
      <v-flex class="oneRow">
        <v-range-slider
          :class="[GET_USER ? '' : 'pt-10'] + ''"
          color="background lighten-1"
          v-model="selectYear"
          :thumb-size="24"
          thumb-label="always"
          hint="Year"
          persistent-hint
          :min="getCurrentYearRange[0]"
          :max="getCurrentYearRange[1]"
        ></v-range-slider>
      </v-flex>
      <v-flex class="oneRow">
        <v-btn class="mt-4 body-1" style="width:100%" @click="sortMovies" text>Filter</v-btn>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "MoviesFilter",
  data: () => ({
    selectType: "mostPopular",
    selectGenre: "",
    selectYear: "",
    selectLike: "",
    selectList: "",
    listTypes: [
      { name: "Most popular", value: "mostPopular" },
      { name: "Top Rated", value: "topRated" },
      { name: "Upcoming", value: "upcoming" },
      { name: "Now Playing", value: "nowPlaying" }
    ],
    likeTypes: [
      { name: "All", value: "" },
      { name: "Not liked only", value: "0" }
    ],
    inListTypes: [
      { name: "All", value: "" },
      { name: "Only not in list", value: "0" }
    ],
    genres: null
  }),
  computed: {
    ...mapGetters(["GET_USER"]),
    getCurrentYearRange() {
      return [1900, new Date().getFullYear() + 10];
    }
  },
  methods: {
    sortMovies() {
      this.$emit("clicked", [
        { name: "type", sort: this.selectType },
        { name: "genre", sort: this.selectGenre },
        { name: "like", sort: this.selectLike },
        { name: "list", sort: this.selectList },
        { name: "year", sort: this.selectYear }
      ]);
    },
    async getAllGenres() {
      await this.$store.dispatch("GET_MOVIES_GENRES").then(data => {
        var genres = [];
        data.forEach(element => {
          genres.push({ name: element.name });
        });
        this.genres = genres;
      });
    }
  },
  beforeMount() {
    this.getAllGenres();
    this.selectYear = this.getCurrentYearRange;
  }
};
</script>

<style scoped>
.oneRow {
  width: 100%;
}
</style>