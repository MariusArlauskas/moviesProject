<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn text rounded class="mt-2 search float-right" v-on="on">
        Search
        <v-icon>search</v-icon>
      </v-btn>
    </template>

    <v-card
      style="border-radius:25px; position: absolute; top:10%; left:30%"
      width="40%"
      min-width="200px"
      color="secondary lighten-1"
    >
      <v-form @submit.prevent="searchRecord()">
        <v-text-field
          style="overflow: hidden"
          prepend-inner-icon="search"
          dark
          hint="search"
          placeholder="Search for a record"
          dense
          hide-details
          clearable
          rounded
          outlined
          v-model="title"
          autofocus
        ></v-text-field>
      </v-form>
    </v-card>

    <v-card
      dark
      v-show="movies.length > 0"
      style="border-radius:10px; position: absolute; top:20%; left:25%; overflow-y: scroll"
      class="noScrollbar"
      width="50%"
      min-width="200px"
      height="60%"
      color="secondary lighten-1"
    >
      <div v-for="(movie, index) in this.movies" :key="index">
        <v-layout
          @click="closeDialog(movie.movieId)"
          class="fullRow caption font-weight-light mx-0"
          align-center
          style="height: 50px; width:100%; cursor:pointer"
          row
        >
          <v-flex style="height:40px; margin-left: 10px; max-width: 40px; min-width:40px">
            <v-img
              v-if="typeof movie.posterPath !== 'undefined' && movie.posterPath !== null"
              height="100%"
              :src="movie.posterPath"
            ></v-img>
            <v-img
              v-else
              style="background:var(--v-background-lighten1)"
              height="100%"
              width="100%"
            ></v-img>
          </v-flex>
          <v-col
            class="text-no-wrap body-1 font-weight-medium"
            style="margin-left:1%; max-width:70%; min-width:70%; overflow-x: hidden"
          >{{ movie.title }}</v-col>
        </v-layout>
        <v-divider v-if="index != Object.keys(movies).length - 1"></v-divider>
      </div>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "SearchDialog",
  data: () => ({
    dialog: false,
    title: "",
    movies: []
  }),
  methods: {
    closeDialog(id) {
      this.movies = [];
      this.dialog = false;
      this.$router.push({
        name: "MovieMainWall",
        params: { id: id }
      });
    },
    searchRecord() {
      this.$store
        .dispatch("SEARCH_MOVIES", { search: this.title })
        .then(data => {
          if (data && data.constructor === Array) {
            this.movies = data;
          }
        })
        .catch(() => {
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Nothing found!!",
            alertClass: "error"
          });
        });
    }
  }
};
</script>

<style scoped>
.search {
  margin-right: 15%;
}
.fullRow {
  width: 100%;
}
.fullRow:hover {
  background-color: var(--v-background-lighten2);
}
</style>