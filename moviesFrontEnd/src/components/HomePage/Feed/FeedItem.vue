<template>
  <v-card class="background lighten-1 mb-3" flat>
    <v-list-item class="background header pl-2">
      <router-link :to="{ name: 'ProfileMainWall', params: { id: item.userId } }">
        <v-list-item-avatar class="mb-0" size="25">
          <img :src="item.userProfilePicture" />
        </v-list-item-avatar>
      </router-link>
      <v-list-item-content class="pb-0">
        <v-list-item-subtitle>
          <router-link
            class="grey--text text--lighten-1"
            style="text-decoration: none"
            :to="{ name: 'ProfileMainWall', params: { id: item.userId } }"
          >{{ item.userName }}</router-link>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-row class="mx-0 mt-2 px-1">
      <v-spacer></v-spacer>
      <span v-if="depth < 2" class="body-2 font-weight-thin">{{ item.children.length }}</span>
      <v-btn v-show="depth < 2" right x-small icon @click="openComments=!openComments">
        <v-icon>comment</v-icon>
      </v-btn>
    </v-row>
    <v-card-text
      ref="message"
      class="py-1 pb-2"
      style="max-width:100%; overflow: hidden; white-space: pre-line;"
      v-html="decodeHtml(item.message)"
    ></v-card-text>
    <v-divider v-show="this.long"></v-divider>
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

    <v-slide-y-transition>
      <v-card v-if="openComments && depth < 2" class="px-1 pb-1" color="transparent" flat>
        <v-container
          class="noScroll background px-8 py-1"
          style="overflow-y: scroll; max-height:600px"
        >
          <CommentBox
            v-if="GET_USER"
            @clicked="childAction"
            :parentId="parseInt(item.id)"
            :button="false"
          />
          <component
            :is="'FeedItem'"
            v-for="child in this.item.children"
            :key="child.id"
            :item="child"
            :depth="depth + 1"
          ></component>
        </v-container>
      </v-card>
    </v-slide-y-transition>
  </v-card>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "FeedItem",
  components: {},
  data: () => ({
    long: false,
    showingFull: true,
    openComments: false
  }),
  props: {
    item: Object,
    depth: Number
  },
  computed: {
    ...mapGetters(["GET_USER"])
  },
  methods: {
    childAction(data) {
      this.item.children = [...[data], ...this.item.children];
    },
    decodeHtml(html) {
      var txt = document.createElement("textarea");
      txt.innerHTML = html;
      return txt.value;
    },
    changeShownText() {
      if (this.showingFull) {
        this.$refs.message.style =
          "max-height: 145px; overflow-y: hidden; white-space: pre-line;";
      } else {
        this.$refs.message.style =
          "max-height: 600px; max-width:100%; overflow-y: scroll; white-space: pre-line;";
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
.noScroll::-webkit-scrollbar {
  display: none;
}
</style>