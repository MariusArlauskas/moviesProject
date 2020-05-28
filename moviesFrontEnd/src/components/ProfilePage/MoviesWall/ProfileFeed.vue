<template>
  <v-layout class="mainContainer">
    <v-card
      :class="[this.$vuetify.breakpoint.md || this.$vuetify.breakpoint.lg || this.$vuetify.breakpoint.xl ? 'feed' : 'feedSmall'] + ' transparent'"
      flat
      dark
    >
      <v-layout style="width: 100%" column>
        <FeedItem
          v-for="(item, index) in this.messages"
          @deleted="deleteMsg(index)"
          :key="item.id"
          :item="item"
          :depth="1"
        />
        <v-progress-circular
          v-show="!this.pagesEnd"
          v-if="typeof this.messages[0] == 'undefined' && this.messages[0] == null"
          size="30"
          width="3"
          indeterminate
          color="accent lighten-2"
          style="margin-left: calc(50% - 15px); margin-top:4%"
        ></v-progress-circular>
        <infinite-loading
          v-show="!this.pagesEnd"
          v-else
          spinner="spiral"
          @infinite="infiniteHandler"
        ></infinite-loading>
        <v-flex
          v-show="this.pagesEnd"
          class="mt-3 mb-5 text-center grey--text body-2"
        >No more messages found</v-flex>
      </v-layout>
    </v-card>
  </v-layout>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import FeedItem from "./../../HomePage/Feed/FeedItem";
export default {
  name: "ProfileMoviesWall",
  components: { FeedItem, InfiniteLoading },
  data: () => ({
    messages: [],
    pagesEnd: false,
    textArea: ""
  }),
  methods: {
    deleteMsg(index) {
      if (
        typeof this.messages[index].parentId == "undefined" ||
        this.messages[index].parentId == null
      ) {
        this.messages.splice(index, 1);
      }
    },
    getMessages() {
      this.$store
        .dispatch("GET_USERS_MESSAGES", {
          offset: this.messages.length,
          userId: this.$route.params.id
        })
        .then(data => {
          if (
            typeof data[0] !== "undefined" &&
            data[0] !== null &&
            data[0] !== ""
          ) {
            this.messages = [...this.messages, ...data];
          } else {
            this.pagesEnd = true;
          }
        })
        .catch(() => {
          this.pagesEnd = true;
        });
    },
    infiniteHandler($state) {
      setTimeout(() => {
        if (this.pagesEnd) {
          $state.complete();
        } else {
          this.getMessages();
          $state.loaded();
        }
      }, 1500);
    }
  },
  created() {
    this.getMessages();
  },
  watch: {
    "$route.params.id": function() {
      this.messages = [];
      this.pagesEnd = false;
      this.getMessages();
    }
  }
};
</script>

<style scoped>
.feed {
  margin-top: 1%;
  margin-left: 30%;
  max-width: 70%;
  width: 70%;
  height: auto;
}
.feedSmall {
  margin-top: 1%;
  max-width: 100%;
  width: 100%;
  height: auto;
}
</style>