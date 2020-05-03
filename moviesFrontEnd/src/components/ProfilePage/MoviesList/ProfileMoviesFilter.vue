<template>
  <v-card class="transparent hidden-sm-and-down" style="position: absolute; width: 12%" flat>
    <v-layout v-if="moviesAddTypes != null || moviesAddTypes.length > 0" class="mx-0" row>
      <v-flex class="oneRow text-center pb-5 pt-2">Filter</v-flex>
      <v-flex class="oneRow">
        <v-select
          class="pb-2"
          v-model="selectType"
          :items="moviesAddTypes"
          hint="Status"
          persistent-hint
          dense
          @change="sortMovies"
        ></v-select>
      </v-flex>
      <v-flex class="oneRow">
        <v-select
          class="pb-10"
          v-model="selectLike"
          :items="likeTypes"
          item-text="name"
          item-value="value"
          hint="Favorite"
          persistent-hint
          dense
          @change="sortMovies"
        ></v-select>
      </v-flex>
      <v-flex class="oneRow">
        <v-range-slider
          color="background lighten-1"
          v-model="selectPersonalRating"
          :thumb-size="24"
          thumb-label="always"
          hint="Personal score"
          persistent-hint
          :min="0"
          :max="10"
          @change="sortMovies"
        ></v-range-slider>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  name: "ProfileMoviesFilter",
  data: () => ({
    selectType: "All",
    selectPersonalRating: [0, 10],
    selectLike: "",
    likeTypes: [
      { name: "All", value: "" },
      { name: "Liked only", value: "1" },
      { name: "Not liked only", value: "0" }
    ]
  }),
  props: {
    moviesAddTypes: null
  },
  computed: {},
  methods: {
    sortMovies() {
      this.$emit("changed", [
        { name: "type", sort: this.selectType },
        { name: "personalRating", sort: this.selectPersonalRating },
        { name: "like", sort: this.selectLike }
      ]);
    }
  }
};
</script>

<style scoped>
.oneRow {
  width: 100%;
}
</style>