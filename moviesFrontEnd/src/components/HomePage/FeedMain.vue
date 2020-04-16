<template>
  <v-layout column>
    <v-btn
      v-show="GET_USER"
      class="caption accent--text text--lighten-2 mb-3"
      text
      height="20px"
      width="100%"
      @click="writeMsg = !writeMsg"
    >
      <span v-if="!writeMsg">
        <v-icon small>keyboard_arrow_down</v-icon>
        <span>Share your thoughts</span>
        <v-icon small>keyboard_arrow_down</v-icon>
      </span>
      <span v-else>
        <v-icon small>keyboard_arrow_up</v-icon>
        <span>Close</span>
        <v-icon small>keyboard_arrow_up</v-icon>
      </span>
    </v-btn>

    <v-slide-y-transition>
      <div v-show="writeMsg">
        <v-card class="background lighten-1" flat>
          <v-list-item class="px-0">
            <v-textarea
              v-model="textArea"
              placeholder="Today I am a bird..."
              hide-details
              outlined
              rows="3"
              auto-grow
            ></v-textarea>
          </v-list-item>
        </v-card>
        <v-slide-y-transition>
          <div v-show="this.textArea != ''">
            <v-card-actions class="justify-end pb-0">
              <v-btn height="22px" text @click="postMsg()">
                <span class="body-2 accent--text text--lighten-2">Post</span>
              </v-btn>
            </v-card-actions>
            <v-divider class="mt-2"></v-divider>
            <v-card class="transparent" outlined>
              <FeedItem
                :item="{ userId: getUserId, userProfilePicture: GET_USER.profilePicture, userName: GET_USER.name, message: textArea }"
              />
            </v-card>
            <v-divider class="mt-2"></v-divider>
          </div>
        </v-slide-y-transition>
      </div>
    </v-slide-y-transition>
    <div :class="[this.writeMsg ? 'mt-5' : '']"></div>
    <FeedItem v-for="item in this.messages" :key="item.id" :item="item" />
    <v-progress-circular
      v-show="!this.pagesEnd"
      v-if="typeof this.messages[0] == 'undefined' && this.messages[0] == null"
      size="30"
      width="3"
      indeterminate
      color="accent lighten-2"
      style="margin-left:47%; margin-top:6.5%"
    ></v-progress-circular>
    <infinite-loading v-show="!this.pagesEnd" v-else spinner="spiral" @infinite="infiniteHandler"></infinite-loading>
    <v-flex
      v-show="this.pagesEnd"
      class="mt-3 mb-5 text-center grey--text body-2"
    >No more messages found</v-flex>
  </v-layout>
</template>

<script>
import { mapGetters } from "vuex";
import InfiniteLoading from "vue-infinite-loading";
import FeedItem from "./FeedItem";
export default {
  name: "FeedMain",
  components: { FeedItem, InfiniteLoading },
  data: () => ({
    writeMsg: false,
    messages: [],
    pagesEnd: false,
    textArea: "",
    timer: ""
  }),
  computed: {
    ...mapGetters(["GET_USER"]),
    getUserId() {
      if (this.$store.getters.GET_USER.id > 0) {
        return this.$store.getters.GET_USER.id; // Add user id to its profile link
      }
      return 0;
    }
  },
  methods: {
    fetchComment() {
      if (this.messages[0].id == "undefined") {
        clearInterval(this.timer);
      }
      this.$store
        .dispatch("GET_MESSAGES", {
          page: 0,
          id: this.messages[0].id
        })
        .then(data => {
          if (
            typeof data[0] !== "undefined" &&
            data[0] !== null &&
            data[0] !== ""
          ) {
            this.messages = [...data, ...this.messages];
          }
        })
        .catch(() => {
          clearInterval(this.timer);
        });
    },
    postMsg() {
      this.$store
        .dispatch("POST_MESSAGE", this.textArea)
        .then(data => {
          data.userId = this.$store.getters.GET_USER.id;
          data.userName = this.$store.getters.GET_USER.name;
          data.userProfilePicture = this.$store.getters.GET_USER.profilePicture;
          this.messages = [...[data], ...this.messages];
          this.textArea = "";
          this.writeMsg = false;
          this.$store
            .commit("SET_NOTIFICATION", {
              display: true,
              text: "Posted a message!",
              alertClass: "success"
            })
            .catch(() => {});
        })
        .catch(() => {
          this.pagesEnd = true;
        });
    },
    getMessages() {
      this.$store
        .dispatch("GET_MESSAGES", { page: this.messages.length + 1, id: 0 })
        .then(data => {
          if (
            typeof data[0] !== "undefined" &&
            data[0] !== null &&
            data[0] !== ""
          ) {
            this.messages = [...this.messages, ...data];
          } else {
            this.pagesEnd = true;
          }
        })
        .catch(() => {
          this.pagesEnd = true;
        });
    },
    infiniteHandler($state) {
      setTimeout(() => {
        if (this.pagesEnd) {
          $state.complete();
        } else {
          this.getMessages();
          $state.loaded();
        }
      }, 1500);
    }
  },
  created() {
    this.getMessages();
    this.timer = setInterval(this.fetchComment, 10000);
  },
  beforeDestroy() {
    clearInterval(this.timer);
  }
};
</script>

<style>
</style>