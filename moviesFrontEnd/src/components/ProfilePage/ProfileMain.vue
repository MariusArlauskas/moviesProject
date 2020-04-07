<template>
  <v-flex class="mx-0 px-0" style="margin-top: -9px; width:100; height:100%">
    <v-card class="topContainer secondary" dark flat>
      <v-layout row style="padding: 20px 120px 20px 7%; height:100%; width:100%">
        <v-card class="py-0 transparent" style="min-width:553px; width: 55%; height: 100%" flat>
          <v-card-title
            class="font-italic font-weight-thin pb-4 pt-0 justify-center"
          >Self description</v-card-title>
          <v-card-text class="desc" style="height: 80%; overflow-y: scroll">
            <div>{{ this.user.description }}</div>
          </v-card-text>
        </v-card>
        <v-col style="min-width:100px; width: 5%"></v-col>
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
        <v-card
          img
          class="transparentt"
          style="max-width:12%; width:12%; min-width:178px; position: absolute; left: 58%"
        >
          <v-img width="100%" :src="this.user.profilePicture"></v-img>
        </v-card>
      </v-layout>
    </v-card>
    <v-container class="mainContainer"></v-container>
  </v-flex>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Profile",
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
</style>
