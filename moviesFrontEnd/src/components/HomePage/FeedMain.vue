<template>
  <v-layout column>
    <FeedItem />
  </v-layout>
</template>

<script>
import FeedItem from "./FeedItem";
export default {
  name: "Feed",
  components: { FeedItem },
  data: () => ({
    items: []
  }),
  methods: {},
  beforeMount() {}
};
</script>

<style>
</style>