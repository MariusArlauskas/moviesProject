<template>
  <v-flex class="mx-0 px-0" style="margin-top: -9px; width:100; height:100%">
    <v-card class="topContainer secondary" dark flat>
      <v-layout
        justify-center
        v-if="this.user.name"
        row
        style="padding: 20px 120px 20px 7%; height:100%; width:100%"
      >
        <v-card class="py-0 transparent" style="min-width:553px; width: 55%; height: 100%" flat>
          <v-card-title class="font-italic font-weight-thin pb-4 pt-0 justify-center">About me</v-card-title>
          <v-card-text class="desc" style="height: 80%; overflow-y: scroll">
            <div>{{ this.user.description }}</div>
          </v-card-text>
        </v-card>
        <v-spacer style="max-width:5%"></v-spacer>
        <v-card img class="transparent" flat max-width="12%" max-height="100%" min-width="180px">
          <v-img contain max-height="100%" max-width="100%" :src="this.user.profilePicture"></v-img>
        </v-card>
        <v-spacer style="max-width:5%"></v-spacer>
        <v-card class="transparent" style="width: 15%" flat>
          <v-card-title class="font-weight-thin pb-0 px-0">Users name</v-card-title>
          <v-row class="mx-0">{{ this.user.name }}</v-row>
          <v-card-title class="font-weight-thin py-0 px-0">Age</v-card-title>
          <v-row class="mx-0">{{ userAge }}</v-row>
          <v-card-title class="font-weight-thin py-0 px-0">Registered from</v-card-title>
          <v-row></v-row>
          <!-- <v-row class="font-weight-thin">Favorites count</v-row>
          <v-row></v-row>-->
        </v-card>
      </v-layout>
    </v-card>
    <v-divider class="secondary lighten-1"></v-divider>
    <v-tabs background-color="secondary" dark>
      <v-tab :to="{name: 'ProfileMainWall'}" :router="true" class="tab font-weight-thin">Main</v-tab>
      <v-tab :to="{name: 'ProfileMoviesList'}" :router="true" class="font-weight-thin">Movies</v-tab>
    </v-tabs>
    <ProfileMainWall v-show="this.$route.name == 'Profile'" />
    <router-view />
  </v-flex>
</template>

<script>
import ProfileMainWall from "./MainWall";
import { mapGetters } from "vuex";
export default {
  name: "Profile",
  components: { ProfileMainWall },
  data: () => ({
    user: {}
  }),
  computed: {
    ...mapGetters(["GET_API_URL", "GET_USER"]),
    userAge() {
      return new Date().getFullYear() - parseInt(this.user.birthDate);
    }
  },
  methods: {
    setUserFromId() {
      this.$store
        .dispatch("GET_USER_PROFILE_BY_ID", {
          id: this.$route.params.id
        })
        .then(data => {
          this.user = data;
        });
    }
  },
  beforeMount() {
    this.setUserFromId();
  },
  watch: {
    "$route.params.id": function() {
      this.setUserFromId();
    }
  }
};
</script>

<style scoped>
.topContainer {
  width: 100%;
  border-radius: 0%;
  max-height: 35%;
  height: 35%;
}
.desc::-webkit-scrollbar {
  display: none;
}
.tab {
  margin-left: 10%;
}
</style>
