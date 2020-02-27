<template>
  <v-container v-bind:class="getClass">
    {{ this.$route.name }}
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
.layoutSide {
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
}
</style>
