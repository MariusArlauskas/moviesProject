<template>
  <!-- <v-container v-bind:class="getClass"> -->
  <v-container class="mr-10 ml-10" style="position:absolute">
    <v-container class="secondary lighten-1 white--text leftColumn">news</v-container>
    <v-container class="middleColumn secondary lighten-1">chat</v-container>
    <v-container class="secondary lighten-1 white--text hidden-xs-and-down rightColumn">mystuff</v-container>
  </v-container>
</template>

<script>
export default {
  name: "HomePage",
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

<style>
.leftColumn {
  width: 29%;
  position: absolute;
  margin-left: 0;
  left: 0;
  right: 0;
}
.middleColumn {
  width: 40%;
  position: absolute;
  padding: 0;
  margin-left: 30%;
  left: 0;
  right: 0;
  flex-wrap: wrap;
}
.rightColumn {
  width: 29%;
  position: absolute;
  margin-left: 71%;
  left: 0;
  right: 0;
}
/* .layoutSide {
  height: 100%;
  width: 90%;
  margin: 0 auto 0 auto;
  background: rgb(236, 236, 236);
}
.layoutMain {
  max-width: 100%;
  height: 100%;
  width: 100%;
  background: rgb(236, 236, 236);
} */
</style>
