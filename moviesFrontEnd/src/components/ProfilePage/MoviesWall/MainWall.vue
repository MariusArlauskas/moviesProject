<template>
  <v-layout class="mainContainer">
    <ProfileFeed :userId="this.userId" />
  </v-layout>
</template>

<script>
import ProfileFeed from "./ProfileFeed";
export default {
  name: "ProfileMainWall",
  components: { ProfileFeed },
  props: {
    userId: Number
  }
};
</script>

<style scoped>
</style>