<template>
  <v-app>
    <headerCustom />

    <router-view></router-view>

    <v-footer height="auto" color="rgb(9, 93, 172)">
      <v-layout justify-center>
        <v-flex text-xs-center white--text style="font-family: 'Merienda One', cursive;">
          &copy;2019
          <strong >Marius</strong>
        </v-flex>
    </v-layout>
    </v-footer>
  </v-app>
</template>

<script>
import headerCustom from "../src/components/Header";

export default {
  name: "mainPage",
  components: { 
    headerCustom,
  },

  data: () => ({
    //
  })
};
</script>
