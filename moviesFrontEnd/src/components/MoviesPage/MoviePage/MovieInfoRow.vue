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
        <v-row v-if="getUser()" class="mx-0 mt-3">
          <v-menu transition="slide-x-transition" bottom close-on-click offset-y>
            <template v-slot:activator="{ on }">
              <v-btn
                style="width:80%"
                small
                outlined
                color="accent lighten-2"
                :ripple="false"
                v-on="on"
              >
                <span
                  v-if="typeof moviesAddTypes[movie.relationTypeId] !== 'undefined' && moviesAddTypes[movie.relationTypeId] !== null && moviesAddTypes[movie.relationTypeId] != '' && movie.relationTypeId != 0"
                >{{ moviesAddTypes[movie.relationTypeId] }}</span>
                <span v-else>Add to list</span>
              </v-btn>
            </template>

            <v-list class="text-center" style="background: var(--v-primary-lighten2)" dark dense>
              <v-list-item
                v-for="(moviesAddTypeName, moviesAddTypeId) in moviesAddTypes"
                :key="moviesAddTypeId"
                @click="addUserMovie(moviesAddTypeId, moviesAddTypeName)"
              >
                <v-list-item-title
                  :class="[moviesAddTypeId == 0 ? 'accent--text text--lighten-2' : '']"
                >{{ moviesAddTypeName }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-row>
        <v-row
          v-show="getUser()"
          v-if="movie.relationTypeId != 0 && movie.relationTypeId != null"
          class="mx-0 mt-2"
        >
          <v-menu transition="slide-x-transition" bottom close-on-click offset-y>
            <template v-slot:activator="{ on }">
              <v-btn
                style="width:80%"
                small
                outlined
                color="accent lighten-2"
                :ripple="false"
                v-on="on"
              >
                <span
                  class="subtitle-1 font-weight-black"
                  v-if="typeof movie.userRating !== 'undefined' && movie.userRating !== null && movie.userRating != '' && movie.userRating != 0"
                >{{ movie.userRating }}</span>
                <span v-else>Not rated</span>
              </v-btn>
            </template>

            <v-list style="background: var(--v-primary-lighten2)" class="text-center" dark dense>
              <v-list-item v-for="index in 10" :key="index" @click="addUserRating(index)">
                <v-list-item-title>{{ index }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-row>
      </v-card>
      <v-card img class="transparent" flat max-width="12%" max-height="100%" min-width="180px">
        <v-img
          v-if="typeof this.movie.posterPath != 'undefined' && this.movie.posterPath != null"
          contain
          max-height="100%"
          max-width="100%"
          :src="this.movie.posterPath"
        ></v-img>
      </v-card>
      <v-spacer></v-spacer>
      <v-card class="py-0 transparent" style="min-width:553px; width: 65%; height: 100%" flat>
        <v-card-title class="font-italic font-weight-thin pb-4 pt-0" style="overflow-y: hidden">
          <v-btn
            class="mr-3"
            v-if="getUser()"
            x-small
            color="accent lighten-2"
            @click="addUserMovie(-1, 'Favorite')"
            :ripple="false"
            icon
          >
            <v-icon size="25" v-if="movie.isFavorite == 1">{{ this.likeIcon }}</v-icon>
            <v-icon size="25" v-else>{{ this.nolikeIcon }}</v-icon>
          </v-btn>
          {{ this.movie.originalTitle }}
        </v-card-title>
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
    movie: {},
    moviesAddTypes: {},
    nolikeIcon: "mdi-heart-outline",
    likeIcon: "mdi-heart"
  }),
  methods: {
    addUserRating(rating) {
      this.$store
        .dispatch("ADD_MOVIE_RATING", {
          userId: this.$store.getters.GET_USER.id,
          movieId: this.movie.movieId,
          rating: rating
        })
        .then(() => {
          var msg = this.movie.title + " rated " + rating + "!";
          var color = "success";
          this.movie.userRating = rating;
          this.notify(msg, color);
        })
        .catch(() => {
          this.error = true;
        });
    },
    removeUserMovie() {
      this.$store
        .dispatch("ADD_MOVIE_STATUS", {
          userId: this.$store.getters.GET_USER.id,
          movieId: this.movie.movieId,
          relationType: this.movie.relationTypeId
        })
        .then(() => {
          this.movie.relationTypeId = 0;
          this.$store
            .commit("SET_NOTIFICATION", {
              display: true,
              text: this.movie.title + " removed from list!",
              alertClass: "warning"
            })
            .catch(() => {
              this.error = true;
            });
        })
        .catch(() => {
          this.error = true;
        });
    },
    addUserMovie(statusId, statusName) {
      if (statusId == 0) {
        this.removeUserMovie();
        return;
      }
      if (this.movie.relationTypeId == statusId) {
        let msg = this.movie.title + " is already " + statusName + "!";
        var color = "warning";
        this.notify(msg, color);
        return;
      }
      if (statusId == -1) {
        statusId += 1;
      }
      this.$store
        .dispatch("ADD_MOVIE_STATUS", {
          userId: this.$store.getters.GET_USER.id,
          movieId: this.movie.movieId,
          relationType: statusId
        })
        .then(() => {
          var msg = this.movie.title + " added as " + statusName + "!";
          var color = "success";
          if (statusId == 0) {
            if (this.movie.isFavorite == 1) {
              msg = this.movie.title + " is not favorite anymore!";
              this.movie.isFavorite = 0;
            } else {
              this.movie.isFavorite = 1;
            }
          } else {
            this.movie.relationTypeId = statusId;
          }
          this.notify(msg, color);
        })
        .catch(() => {
          let msg = this.movie.title + " is already " + statusName + "!";
          var color = "warning";
          this.notify(msg, color);
        });
    },
    notify(msg, color) {
      this.$store.commit("SET_NOTIFICATION", {
        display: true,
        text: msg,
        alertClass: color
      });
    },
    getUser() {
      return this.$store.getters.GET_USER;
    },
    getMovieAddTypes() {
      this.$store.dispatch("GET_MOVIES_ADD_TYPES").then(data => {
        var moviesAddTypesArray = [];
        moviesAddTypesArray[0] = "Remove";
        data.forEach(element => {
          moviesAddTypesArray[element.id] = element.name;
        });
        this.moviesAddTypes = moviesAddTypesArray;
      });
    },
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
    this.getMovieAddTypes();
    this.getFullMovieInfo();
  },
  watch: {
    "$route.params.id": function() {
      this.getFullMovieInfo();
    }
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