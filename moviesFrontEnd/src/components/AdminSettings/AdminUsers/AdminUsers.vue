<template>
  <v-card class="background lighten-1 py-1 px-1" flat dark>
    <v-layout class="background mx-0" style="width:100%" row>
      <v-progress-circular
        v-show="!this.noData"
        v-if="typeof this.users[0] == 'undefined' && this.users[0] == null"
        size="30"
        width="3"
        indeterminate
        color="accent lighten-2"
        style="margin-left:calc(50% - 15px); margin-top: 7%; margin-bottom: 7%"
      ></v-progress-circular>
      <v-card v-show="!this.noData" v-else class="transparent px-3 pb-3" width="100%" flat>
        <v-flex class="pl-3 pt-2 title font-weight-medium">Users</v-flex>
        <v-layout class="mt-0 mb-5 listHeader" style="height: 35px" row>
          <v-col class="px-0" style="margin-left: 30%; max-width:60px; min-width:60px">1</v-col>
          <v-col class="px-0" style="margin-left: 20.5%; max-width:110px; min-width:110px">2</v-col>
          <v-col class="px-0" style="margin-left: 1%; max-width:60px; min-width:60px">3</v-col>
          <v-col
            class="px-0"
            style="margin-left: auto; margin-right:-2%; max-width:70px; min-width:70px"
          >4</v-col>
          <v-col
            class="px-0"
            style="margin-left: auto; margin-right:2%; max-width:70px; min-width:70px"
          >5</v-col>
        </v-layout>
        <v-container class="py-0 px-0" v-for="(item, index) in this.users" :key="item.id">
          <UserItem :item="item" />
          <v-divider v-if="index != Object.keys(users).length - 1"></v-divider>
        </v-container>
      </v-card>
    </v-layout>
    <v-flex v-show="this.noData" class="mt-3 pt-5 text-center grey--text body-2">No users found</v-flex>
  </v-card>
</template>

<script>
import UserItem from "./UserItem";
export default {
  name: "AdminUsers",
  components: { UserItem },
  data: () => ({
    users: [],
    noData: false
  }),
  methods: {
    getUsers() {
      this.$store
        .dispatch("GET_USERS")
        .then(data => {
          if (data && data.constructor === Array) {
            this.users = data;
          } else {
            this.noData = true;
          }
        })
        .catch(() => {
          this.noData = true;
        });
    }
  },
  mounted() {
    this.getUsers();
  }
};
</script>

<style scoped>
</style>