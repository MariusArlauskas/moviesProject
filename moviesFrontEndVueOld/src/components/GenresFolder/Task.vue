<template>
  <v-list-item ripple v-on:click.prevent="openInfoModal()">
    <v-list-item-action>
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
    </v-list-item-action>
    <v-list-item-content>
      <v-list-item-title>{{ task.name }}</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
</template>

<script>
export default {
  name: "task",
  props: {
    task: Object,
    index: Number
  },
  data: () => ({}),
  methods: {
    openInfoModal() {
      this.$router.push({
        name: "genreMovieInfoModal",
        params: {
          movieId: this.task.movie_id,
          movie: this.task,
          type: "genreMovie"
        }
      });
    }
  }
};
</script>