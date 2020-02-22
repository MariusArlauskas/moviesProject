<template>
  <div style="height: 100%">
    <v-card style="height: 100%; overflow: hidden">
      <v-toolbar color="blue" dark>
        <v-toolbar-title style="font-family: 'Carter One', cursive;">{{ currentMovie["name"] }}</v-toolbar-title>
      </v-toolbar>

      <v-container style="height: 40%" class="ml-5 mr-5">
        <v-row>
          <v-col cols="8">
            <v-row>
              <v-content style="font-family: 'Carter One', cursive;">{{ currentMovie["name"] }}</v-content>
            </v-row>
            <v-row
              class="subtitle-2"
            >{{ currentMovie["author"] }} || {{ currentMovie["release_date"] }}</v-row>
          </v-col>
          <v-col cols="1">
            <v-btn v-if="ROLE === 'ROLE_ADMIN'" v-on:click.prevent="openEditModal" color="primary" icon>
              <v-icon>edit</v-icon>
            </v-btn>
          </v-col>
          <v-col cols="1">
            <v-btn v-if="ROLE === 'ROLE_ADMIN'" @click.prevent="deleteMovie" cols="1" icon color="pink">
              <v-icon>delete</v-icon>
            </v-btn>
          </v-col>
        </v-row>
        <v-row
          style="width: 98%; max-height: 75%; height: 75%; overflow-y: scroll; font-family: 'Courgette', cursive;"
        >{{ currentMovie["description"] }}</v-row>
      </v-container>
      <v-content class="pl-5" style="font-family: 'Carter One', cursive;">Genre list</v-content>
      <v-divider></v-divider>
      <v-list two-line style="max-height: 41%; height: 41%; overflow-y: scroll">
        <template v-for="(movieGenre, key) in GENRES">
          <MovieGenre v-bind:key="key" :movieGenre="movieGenre" :index="key" />
        </template>
      </v-list>
      <v-divider></v-divider>
      <v-card-actions v-if="ROLE">
        <v-layout>
          <v-flex>
            <NewMovieGenre />
          </v-flex>
        </v-layout>
      </v-card-actions>
    </v-card>
    <router-view name="moviesEdit"></router-view>
    <router-view name="movieGenreInfoModal"></router-view>
  </div>
</template>

<script>
import MovieGenre from "./MovieGenre";
import NewMovieGenre from "./NewMovieGenre";
export default {
  name: "movieGenres",
  components: { MovieGenre, NewMovieGenre },
  data: () => ({}),
  methods: {
    openEditModal() {
      this.$router.push({
        name: "moviesEdit"
      });
    },
    async deleteMovie() {
      await this.$store
        .dispatch("DELETE_MOVIE", {
          movieId: this.$route.params.id
        })
        .then(() => {
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Movie has been removed!",
            alertClass: "warning"
          });
          this.$store.dispatch("GET_MOVIES");
          this.$router.push({
            name: "todo"
          });
        });
    }
  },
  computed: {
    currentMovie() {
      return this.$store.getters.MOVIE(this.$route.params.id);
    },
    GENRES() {
      return this.$store.getters.GENRES(this.$route.params.id);
    },
    ROLE() {
      return this.$store.getters.ROLE;
    }
  },
  async mounted() {
    await this.$store.dispatch("GET_MOVIE_GENRES", this.$route.params.id);
  }
};
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Carter+One&display=swap');
@import url('https://fonts.googleapis.com/css?family=Courgette&display=swap');
</style>