<template>
  <div>
    <v-btn
      v-show="this.button"
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
        <v-list-item class="px-3 pt-3">
          <v-textarea
            v-model="textArea"
            placeholder="Write your message here..."
            hide-details
            outlined
            rows="1"
            auto-grow
          ></v-textarea>
        </v-list-item>
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
  </div>
</template>

<script>
import FeedItem from "./FeedItem";
import { mapGetters } from "vuex";
export default {
  name: "CommentBox",
  components: { FeedItem },
  data: () => ({
    writeMsg: false,
    textArea: "",
    timer: ""
  }),
  props: {
    parentId: Number,
    button: Boolean
  },
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
    postMsg() {
      this.$store
        .dispatch("POST_MESSAGE", {
          message: this.textArea,
          parentId: this.parentId
        })
        .then(data => {
          data.userId = this.$store.getters.GET_USER.id;
          data.userName = this.$store.getters.GET_USER.name;
          data.userProfilePicture = this.$store.getters.GET_USER.profilePicture;
          this.textArea = "";
          if (this.button) {
            this.writeMsg = false;
          }
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Posted a message!",
            alertClass: "success"
          });
          this.$emit("clicked", data);
        });
    }
  },
  created() {
    if (!this.button) {
      this.writeMsg = true;
    }
  }
};
</script>

<style>
</style>