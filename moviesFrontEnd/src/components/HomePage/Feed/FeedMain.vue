<template>
  <v-layout column>
    <CommentBox v-show="GET_USER" @clicked="childAction" :parentId="0" :button="true" />
    <FeedItem v-for="item in this.messages" :key="item.id" :item="item" :depth="1" />
    <v-progress-circular
      v-show="!this.pagesEnd"
      v-if="typeof this.messages[0] == 'undefined' && this.messages[0] == null"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left: calc(50% - 15px); margin-top:6.5%"
    ></v-progress-circular>
    <infinite-loading v-show="!this.pagesEnd" v-else spinner="spiral" @infinite="infiniteHandler"></infinite-loading>
    <v-flex
      v-show="this.pagesEnd"
      class="mt-3 mb-5 text-center grey--text body-2"
    >No more messages found</v-flex>
  </v-layout>
</template>

<script>
import CommentBox from "./CommentBox";
import { mapGetters } from "vuex";
import InfiniteLoading from "vue-infinite-loading";
import FeedItem from "./FeedItem";
export default {
  name: "FeedMain",
  components: { FeedItem, InfiniteLoading, CommentBox },
  data: () => ({
    messages: [],
    pagesEnd: false,
    timer: ""
  }),
  computed: {
    ...mapGetters(["GET_USER"])
  },
  methods: {
    childAction(data) {
      this.messages = [...[data], ...this.messages];
    },
    fetchComment() {
      if (this.messages[0].id == "undefined") {
        clearInterval(this.timer);
      }
      this.$store
        .dispatch("GET_MESSAGES", {
          page: 0,
          id: this.messages[0].id
        })
        .then(data => {
          if (
            typeof data[0] !== "undefined" &&
            data[0] !== null &&
            data[0] !== ""
          ) {
            this.messages = [...data, ...this.messages];
          }
        })
        .catch(() => {
          clearInterval(this.timer);
        });
    },
    getMessages() {
      this.$store
        .dispatch("GET_MESSAGES", { page: this.messages.length + 1, id: 0 })
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
  beforeMount() {
    this.getMessages();
    // this.timer = setInterval(this.fetchComment, 10000);
  },
  beforeDestroy() {
    // clearInterval(this.timer);
  }
};
</script>

<style>
</style>