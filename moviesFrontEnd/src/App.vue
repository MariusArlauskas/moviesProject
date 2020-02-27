<template>
  <v-app>
    <Header />
    <v-content class="mainBackground">
      <!-- <router-link to="/">Home</router-link> -->

      <router-view />
    </v-content>
    <Footer />
  </v-app>
</template>

<script>
import Header from "./components/Header";
import Footer from "./components/Footer";
export default {
  name: "App",
  components: { Header, Footer }
};
</script>

<style>
.mainBackground {
  background: rgb(162, 176, 226);
  background-image: url("~@/assets/bgpic.jpg");
}

.whiteTransparent {
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.5);
}
</style>
