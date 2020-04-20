<template>
  <v-layout class="mainContainer mt-3" style="width: 100%" flat>
    <v-col cols="2">
      <v-card class="transparent" dark flat>
        <v-list class="transparent" nav>
          <v-list-item class="title font-weight-light justify-center">Navigation</v-list-item>
          <v-list-item
            v-for="(item, index) in settingsList"
            :key="item.title"
            @click="jump(item.href, item.params)"
          >
            <v-list-item-content class="pl-3">{{ item.title }}</v-list-item-content>
            <v-divider v-if="index != Object.keys(settingsList).length - 1"></v-divider>
          </v-list-item>
        </v-list>
      </v-card>
    </v-col>
    <v-col cols="10" class="mt-3">
      <router-view :user="getUser()" />
    </v-col>
  </v-layout>
</template>

<script>
export default {
  name: "AdminMenu",
  data: () => ({
    settingsList: [
      {
        title: "Users",
        href: "AdminUsers",
        params: {}
      }
    ]
  }),
  computed: {
    getUserId() {
      if (this.$store.getters.GET_USER.id > 0) {
        return this.$store.getters.GET_USER.id; // Add user id to its profile link
      }
      return 0;
    }
  },
  methods: {
    getUser() {
      return this.$store.getters.GET_USER;
    },
    jump(routeName, ruoteParams) {
      if (typeof ruoteParams.method != "undefined") {
        var obj = {};
        obj[ruoteParams.name] = eval(ruoteParams.method);
        ruoteParams = obj;
      }
      if (this.$route.name != routeName) {
        this.$router.push({ name: routeName, params: ruoteParams });
      }
    }
  }
};
</script>

<style scoped>
.fullRow {
  width: 100%;
  margin-left: 0;
}
</style>