<template>
  <!-- <v-container v-bind:class="getClass"> -->
  <v-container class="mainContainer" style="position:absolute">
    <v-card class="leftColumn" color="transparent" dark outlined>news</v-card>
    <v-card class="middleColumn" color="transparent" dark outlined>
      <FeedMain />
    </v-card>
    <v-card class="rightColumn" color="transparent" dark outlined>mystuff</v-card>
  </v-container>
</template>

<script>
import FeedMain from "./FeedMain";
export default {
  name: "HomePage",
  components: { FeedMain },
  computed: {
    getClass() {
      return this.$route.name === "HomePage" ? "layoutMain" : "layoutSide";
    },
    theme() {
      return this.$vuetify.theme.dark ? "dark" : "light";
    }
  }
};
</script>

<style scoped>
.leftColumn {
  width: 20%;
  position: absolute;
  margin-left: 0;
  left: 0;
  right: 0;
}
.middleColumn {
  width: 48%;
  position: absolute;
  margin-left: 21%;
  left: 0;
  right: 0;
}
.rightColumn {
  width: 30%;
  position: absolute;
  margin-left: 70%;
  left: 0;
  right: 0;
}
</style>
