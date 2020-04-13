<template>
  <v-card class="background lighten-1 mb-3" flat>
    <v-list-item class="background header">
      <router-link :to="{ name: 'Profile', params: { id: item.userId } }">
        <v-list-item-avatar class="mb-0" size="25">
          <img :src="item.userProfilePicture" />
        </v-list-item-avatar>
      </router-link>
      <v-list-item-content class="pb-0">
        <v-list-item-subtitle>
          <router-link
            class="grey--text text--lighten-1"
            style="text-decoration: none"
            :to="{ name: 'Profile', params: { id: item.userId } }"
          >{{ item.userName }}</router-link>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-card-text class="pb-2 pt-3">{{ item.message }}</v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "FeedItem",
  data: () => ({}),
  props: {
    item: Object
  }
};
</script>

<style scoped>
.header {
  margin-bottom: -5px;
}
</style>