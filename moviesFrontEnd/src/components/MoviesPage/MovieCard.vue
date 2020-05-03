<template>
  <v-card class="movieCard white--text mb-4" min-width="350px" max-width="400px" outlined dark>
    <v-card-title class="primary subtitle-1 py-0 text-no-wrap" style="height: 32px">
      <v-btn
        v-show="GET_USER"
        x-small
        class="ml-0 mr-3"
        color="accent lighten-2"
        @click="addUserMovie(-1, 'Favorite')"
        :ripple="false"
        icon
      >
        <v-icon size="23" v-if="this.item.isFavorite == 1">{{ this.likeIcon }}</v-icon>
        <v-icon size="23" v-else>{{ this.nolikeIcon }}</v-icon>
      </v-btn>
      <v-tooltip top>
        <template v-slot:activator="{ on }">
          <span
            :style="'overflow: hidden; ' + [GET_USER ? 'max-width: 55%; min-width: 150px' : 'max-width: 90%; min-width: 150px']"
            class="font-weight-light"
            v-on="on"
          >{{ item.title }}</span>
        </template>
        <span style="overflow: hidden; min-width: 200px">{{ item.title }}</span>
      </v-tooltip>

      <v-flex
        v-if="this.item.relationTypeId > 0 && GET_USER"
        class="'py-0 px-0 mr-0 ml-auto caption font-weight-thin accent--text text--lighten-2 d-none'"
        style="max-width: 17%; width: auto"
      >{{ moviesAddTypes[this.item.relationTypeId] }}</v-flex>

      <v-flex v-else class="'py-0 px-0 mr-0 ml-auto"></v-flex>

      <v-menu transition="slide-y-transition" bottom close-on-click offset-x>
        <template v-slot:activator="{ on }">
          <v-btn
            v-show="GET_USER"
            small
            class="ml-1 mr-4"
            color="accent lighten-2"
            :ripple="false"
            icon
            v-on="on"
          >
            <v-icon size="23" v-if="item.relationTypeId > 0">{{ listIcon }}</v-icon>
            <v-icon size="23" v-else>{{ nolistIcon }}</v-icon>
          </v-btn>
        </template>

        <v-list style="background: var(--v-primary-lighten1)" dark dense>
          <v-list-item
            v-for="(moviesAddTypeName, moviesAddTypeId) in this.moviesAddTypes"
            :key="moviesAddTypeId"
            @click="addUserMovie(moviesAddTypeId, moviesAddTypeName)"
          >
            <v-list-item-title
              :class="[moviesAddTypeId == 0 ? 'accent--text text--lighten-2' : '']"
            >{{ moviesAddTypeName }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <v-container class="colorIndicator" :style="'background:' + getColor(item.rating)"></v-container>
    </v-card-title>
    <v-layout style="height:190px; width:100%">
      <div style="width:40%">
        <MovieDialog :movie="item" :moviesAddTypes="moviesAddTypes" />
      </div>
      <v-flex outlined style="width:60%; height:100%">
        <v-card flat dark style="width:100%; height:36%; background:transparent">
          <v-row class="mx-0 pt-3 pl-4">
            <v-col class="px-0 py-0 font-italic font-weight-light white--text">{{ item.author }}</v-col>
            <!-- <v-col
              class="pl-0 py-0 font-italic font-weight-light white--text text-right"
            >{{ new Date (item.releaseDate.timestamp * 1000).toLocaleString().substring(0, 10) }}</v-col>-->
            <v-col
              class="pl-0 py-0 font-italic font-weight-light white--text text-right"
            >{{ item.releaseDate }}</v-col>
          </v-row>
          <v-row
            class="mx-0 pt-1 pl-4 pr-3 mr-6 caption text-no-wrap"
            style="overflow-x: hidden"
          >{{ item.genres }}</v-row>
        </v-card>

        <v-card-text
          class="desc white--text caption mt-4 pt-0 pl-4 pr-5"
          style="height:49%; overflow-y: scroll"
        >
          <div
            v-if="typeof item.overview !== 'undefined' && item.overview !== null && item.overview !== ''"
          >{{ item.overview }}</div>
          <div v-else>No description</div>
        </v-card-text>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
import { mapGetters } from "vuex";
import MovieDialog from "./MovieDialog";
export default {
  name: "MovieCard",
  components: { MovieDialog },
  data: () => ({
    isActive: false,
    nolikeIcon: "mdi-heart-outline",
    likeIcon: "mdi-heart",
    nolistIcon: "add",
    listIcon: "done"
  }),
  props: {
    item: Object,
    moviesAddTypes: null
  },
  computed: {
    ...mapGetters(["GET_USER"])
  },
  methods: {
    removeUserMovie() {
      this.$store
        .dispatch("ADD_MOVIE_STATUS", {
          userId: this.$store.getters.GET_USER.id,
          movieId: this.item.movieId,
          relationType: this.item.relationTypeId
        })
        .then(() => {
          this.item.relationTypeId = 0;
          var msg = this.item.title + " removed from list!";
          this.notify(msg, "warning");
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
      if (this.item.relationTypeId == statusId) {
        let msg = this.item.title + " is already " + statusName + "!";
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
          movieId: this.item.movieId,
          relationType: statusId
        })
        .then(() => {
          var msg = this.item.title + " added as " + statusName + "!";
          var color = "success";
          if (statusId == 0) {
            if (this.item.isFavorite == 1) {
              msg = this.item.title + " is not favorite anymore!";
              this.item.isFavorite = 0;
            } else {
              this.item.isFavorite = 1;
            }
          } else {
            this.item.relationTypeId = statusId;
          }
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
    },
    getColor(value) {
      //value from 0 to 1
      var hue = ((0 + (value - 1) / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,40%)"].join("");
    },
    changeLikeIcon() {
      if (this.likeIcon == "mdi-heart-outline") {
        this.likeIcon = "mdi-heart";
      } else {
        this.likeIcon = "mdi-heart-outline";
      }
    },
    changeListIcon() {
      if (this.listIcon == "add") {
        this.listIcon = "done";
      } else {
        this.listIcon = "add";
      }
    }
  }
};
</script>

<style scoped>
.movieCard {
  margin-left: 0.5%;
  margin-right: 0.5%;
  /* background: var(--v-secondary-lighten1); */
  background: transparent;
  max-width: 400px;
  max-height: 230px;
}
.bg {
  background: rgba(12, 16, 23, 0.5);
}
.desc::-webkit-scrollbar {
  display: none;
}
.desc {
  scrollbar-width: none;
}
.colorIndicator {
  border-top-right-radius: 4px;
  padding: 2px;
  margin-right: -16px;
  margin-left: 0;
  width: 4px;
  height: 100%;
}
.noHover:hover {
  background: transparent;
}
</style>