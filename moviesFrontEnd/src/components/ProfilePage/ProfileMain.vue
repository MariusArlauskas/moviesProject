<template>
  <v-flex class="mx-0 px-0" style="margin-top: -9px; width:100">
    <ProfileInfoRow :user="this.user" />
    <v-divider class="secondary lighten-1"></v-divider>
    <v-tabs background-color="secondary" dark>
      <v-tab :to="{name: 'ProfileMainWall'}" :router="true" class="tab font-weight-thin">Main</v-tab>
      <v-tab :to="{name: 'ProfileMoviesList'}" :router="true" class="font-weight-thin">Movies</v-tab>
    </v-tabs>
    <!-- <ProfileMainWall
      v-if="this.user.id"
      v-show="this.$route.name == 'Profile'"
      :userId="this.user.id"
    />-->
    <router-view :userId="this.user.id" />
  </v-flex>
</template>

<script>
// import ProfileMainWall from "./MoviesWall/MainWall";
import ProfileInfoRow from "./ProfileInfoRow";
import { mapGetters } from "vuex";
export default {
  name: "Profile",
  components: { ProfileInfoRow },
  data: () => ({
    user: {}
  }),
  computed: {
    ...mapGetters(["GET_API_URL", "GET_USER"])
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
.tab {
  margin-left: 10%;
}
</style>
