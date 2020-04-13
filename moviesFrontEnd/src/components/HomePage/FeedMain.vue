<template>
  <v-layout column>
    <FeedItem v-for="item in this.messages" :key="item.id" :item="item" />
    <v-progress-circular
      v-show="!this.pagesEnd"
      v-if="typeof this.messages[0] == 'undefined' && this.messages[0] == null"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left:47%; margin-top:6.5%"
    ></v-progress-circular>
    <infinite-loading v-show="!this.pagesEnd" v-else spinner="spiral" @infinite="infiniteHandler"></infinite-loading>
    <v-flex v-show="this.pagesEnd" class="mt-3 text-center grey--text body-2">No more messages found</v-flex>
  </v-layout>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import FeedItem from "./FeedItem";
export default {
  name: "Feed",
  components: { FeedItem, InfiniteLoading },
  data: () => ({
    pagesLoaded: 1,
    messages: [],
    pagesEnd: false
  }),
  methods: {
    getMessages() {
      this.$store
        .dispatch("GET_MESSAGES", this.pagesLoaded)
        .then(data => {
          this.pagesLoaded += 1;
          this.messages = [...this.messages, ...data];
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
          $state.loaded();
          this.getMessages();
        }
      }, 1500);
    }
  },
  mounted() {
    this.getMessages();
  }
};
</script>

<style>
</style>