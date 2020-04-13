<template>
  <v-layout row class="mainContainer mt-3" style="width:100%; height:auto">
    <v-card class="leftColumn" color="transparent" dark outlined>s</v-card>
    <v-card class="middleColumn" color="transparent" dark flat>
      <FeedMain />
    </v-card>
    <v-card class="rightColumn" color="transparent" dark outlined>mystuff</v-card>
  </v-layout>
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
  margin-left: 0;
}
.middleColumn {
  width: 48%;
  margin-left: 1%;
}
.rightColumn {
  width: 30%;
  margin-left: 1%;
}
</style>
