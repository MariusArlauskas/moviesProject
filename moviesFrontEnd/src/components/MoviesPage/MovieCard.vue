<template>
  <v-card class="movieCard white--text" max-width="15%">
    <v-card-title class="subtitle-1">Australian beaches</v-card-title>
    <v-img height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"></v-img>

    <v-card-subtitle class="pb-0 font-italic font-weight-medium white--text">Peter Griffin</v-card-subtitle>

    <v-card-text class="white--text font-weight-lights">
      <div>Whitehaven Beach</div>

      <div>Whitsunday Island, Whitsunday Islands</div>
    </v-card-text>

    <v-card-actions>
      <v-btn color="orange" text>Share</v-btn>

      <v-btn color="orange" text>Explore</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {};
</script>

<style scoped>
.movieCard {
  margin-left: 1%;
  background: var(--v-secondary-lighten1);
}
.bg {
  background: rgba(12, 16, 23, 0.5);
}
</style>