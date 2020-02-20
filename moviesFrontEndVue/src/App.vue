<template>
  <v-app>
    <headerCustom />

    <router-view></router-view>
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
