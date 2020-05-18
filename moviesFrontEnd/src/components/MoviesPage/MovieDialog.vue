<template>
  <v-dialog v-model="dialog" max-width="600px" min-width="600px">
    <template v-slot:activator="{ on }">
      <v-flex style="width:100%; height:100%; cursor:pointer" v-ripple v-on="on">
        <v-img
          v-if="typeof movie.posterPath !== 'undefined' && movie.posterPath !== null"
          height="100%"
          :src="movie.posterPath"
        ></v-img>
        <v-img v-else style="background:var(--v-background-lighten1)" height="100%" width="100%"></v-img>
      </v-flex>
    </template>
    <v-card
      dark
      width="52%"
      color="secondary lighten-1"
      style="position:absolute; left: 24%; top: 28.5%"
    >
      <v-card-title class="headline lighten-2" style="padding-left:15%" primary-title>
        <v-img
          v-if="typeof this.movie.posterPath !== 'undefined' && this.movie.posterPath !== null"
          style="height: 250px; max-width:170px; margin-top: 0%; margin: -187px 0 -10px -18.5%"
          contain
          :src="movie.posterPath"
        ></v-img>
        <span
          style="padding-left:17px; max-height:30px; max-width: 50%; overflow: hidden"
        >{{ movie.title }}</span>
        <v-btn
          class="ml-auto mr-3"
          v-if="getUser()"
          x-small
          color="accent lighten-2"
          @click="addUserMovie(-1, 'Favorite')"
          :ripple="false"
          icon
        >
          <v-icon size="35" v-if="movie.isFavorite == 1">{{ this.likeIcon }}</v-icon>
          <v-icon size="35" v-else>{{ this.nolikeIcon }}</v-icon>
        </v-btn>
        <v-col
          style="width:100px; max-width:150px; min-width:150px"
          :class="'py-0 pr-0 ' + [getUser() ? '' : 'ml-auto']"
        >Rating: {{ movie.rating }}</v-col>
        <v-col class="colorIndicator" :style="'background:' + getColor(movie.rating)"></v-col>
      </v-card-title>
      <v-divider></v-divider>

      <v-layout style="width:100%" class="mx-0" row>
        <v-col class="px-3" style="max-width: 170px">
          <v-row class="mx-0">
            <v-menu v-if="getUser()" transition="slide-x-transition" bottom close-on-click offset-y>
              <template v-slot:activator="{ on }">
                <v-btn
                  style="width:100%"
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
            justify="center"
            class="mx-0 mt-3"
            v-if="movie.relationTypeId != 0 && movie.relationTypeId != null"
            v-show="getUser()"
          >
            <span class="body-1 font-weight-light">Personal rating</span>
          </v-row>
          <v-row
            v-show="getUser()"
            class="mx-0"
            v-if="movie.relationTypeId != 0 && movie.relationTypeId != null"
          >
            <v-menu transition="slide-x-transition" bottom close-on-click offset-y>
              <template v-slot:activator="{ on }">
                <v-btn
                  style="width:100%"
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
        </v-col>
        <v-col class="mr-2">
          <v-flex>
            <strong>Original title:</strong>
            {{ movie.originalTitle }}
          </v-flex>
          <v-flex class="font-italic font-weight-light">{{ movie.genres }}</v-flex>
          <v-flex></v-flex>
          <v-card-text>
            <v-row
              class="pb-1"
              style="font-family: 'Courgette', cursive;"
              v-if="typeof movie.overview !== 'undefined' && movie.overview !== null && this.movie.overview !== ''"
            >{{ movie.overview }}</v-row>
            <v-row class="pb-1" style="font-family: 'Courgette', cursive;" v-else>No description</v-row>
          </v-card-text>
        </v-col>
      </v-layout>
      <v-divider></v-divider>

      <v-card-actions>
        <v-btn text @click="dialog = false">Back</v-btn>
        <v-spacer></v-spacer>
        <v-btn text>
          <router-link
            class="white--text"
            :to="{ name: 'MovieMainWall', params: { id: this.movie.movieId } }"
          >Open movie</router-link>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "MovieDialog2",
  props: {
    movie: Object,
    moviesAddTypes: null
  },
  data: () => ({
    dialog: false,
    nolikeIcon: "mdi-heart-outline",
    likeIcon: "mdi-heart"
  }),
  methods: {
    log() {
      console.log(this.movie);
    },
    getUser() {
      return (
        this.$store.getters.GET_USER &&
        (this.$store.getters.GET_USER.id == this.$route.params.id ||
          !this.$route.params.id)
      );
    },
    getColor(value) {
      //value from 0 to 1
      var hue = ((0 + (value - 1) / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,40%)"].join("");
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
          this.error = true;
        });
    },
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
    notify(msg, color) {
      this.$store
        .commit("SET_NOTIFICATION", {
          display: true,
          text: msg,
          alertClass: color
        })
        .catch(() => {
          this.error = true;
        });
    }
  }
};
</script>

<style scoped>
div a {
  text-decoration: none;
}
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