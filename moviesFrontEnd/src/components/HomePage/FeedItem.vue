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

    <v-card-text ref="message" class="pb-2 pt-3">{{ item.message }}</v-card-text>
    <v-btn
      v-show="this.long"
      class="caption accent--text text--lighten-2"
      text
      height="20px"
      width="100%"
      @click="changeShownText()"
    >
      <span v-if="!this.showingFull">Show more</span>
      <span v-else>Show less</span>
    </v-btn>
  </v-card>
</template>

<script>
export default {
  name: "FeedItem",
  data: () => ({
    long: false,
    showingFull: true
  }),
  props: {
    item: Object
  },
  methods: {
    changeShownText() {
      if (this.showingFull) {
        this.$refs.message.style = "max-height: 145px; overflow-y: hidden";
      } else {
        this.$refs.message.style = "";
      }
      this.showingFull = !this.showingFull;
    }
  },
  mounted() {
    if (this.$refs.message.clientHeight > 145) {
      this.long = true;
      this.changeShownText();
    }
  }
};
</script>

<style scoped>
.header {
  margin-bottom: -5px;
}
</style>