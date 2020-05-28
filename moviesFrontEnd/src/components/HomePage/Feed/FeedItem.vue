<template>
  <div>
    <v-card v-if="this.edit" class="background my-10" flat>
      <CommentBox
        @clicked="childAction"
        @edited="edit = !edit"
        :parentId="parseInt(item.parentId)"
        :button="false"
        :edit="true"
        :editId="parseInt(item.id)"
        :text="decodeHtml(item.message)"
      />
    </v-card>
    <v-card v-else class="background lighten-1 mb-3" flat>
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

      <v-row v-if="depth > 0" class="mx-0 mt-2 px-1">
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" persistent max-width="290">
          <template v-slot:activator="{ on }">
            <v-btn
              v-show="GET_USER.id == item.userId && !(typeof GET_USER.chatBannedUntil != 'undefined' && GET_USER.chatBannedUntil != null && new Date(GET_USER.chatBannedUntil) > new Date())"
              style="margin-top:-1px;"
              color="accent lighten-2"
              right
              x-small
              icon
              v-on="on"
            >
              <v-icon size="17">delete</v-icon>
            </v-btn>
          </template>
          <v-card class="primary lighten-1" dark>
            <v-card-title style="word-break: normal;">
              <p class="title text-center">
                Are you sure you want to
                <b class="title accent--text text--lighten-2">permanently</b> delete this
                message?
              </p>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn text @click="dialog = false">Cancel</v-btn>
              <v-spacer></v-spacer>
              <v-btn color="accent lighten-2" text @click="deleteMsg()">Delete</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-btn
          v-show="GET_USER.id == item.userId && (typeof item.children == 'undefined' || item.children.length < 1) && !(typeof GET_USER.chatBannedUntil != 'undefined' && GET_USER.chatBannedUntil != null && new Date(GET_USER.chatBannedUntil) > new Date())"
          style="margin:-1px 10px 0 0"
          right
          x-small
          icon
          @click="edit=!edit"
        >
          <v-icon size="17">edit</v-icon>
        </v-btn>
        <span v-if="depth < 2" class="body-2 font-weight-thin">{{ item.children.length }}</span>
        <v-btn v-show="depth < 2" right x-small icon @click="openComments=!openComments">
          <v-icon>comment</v-icon>
        </v-btn>
      </v-row>
      <v-row v-else class="mx-0 mt-2 px-1"></v-row>

      <div v-if="typeof item.posterPath !== 'undefined' && item.posterPath !== null">
        <v-row>
          <v-col class="px-0 ml-7" style="max-width: 13%">
            <router-link :to="{ name: 'MovieMainWall', params: { id: item.movieId } }">
              <v-img height="120px" :src="item.posterPath"></v-img>
            </router-link>
          </v-col>
          <v-col>
            <div class="pl-2 pb-3">
              <v-row class="title" style="width:100%">Review</v-row>
              <v-row
                class="accent--text text--lighten-3 subtitle-2 font-italic font-weight-medium"
                style="width:100%"
              >{{ item.title }}</v-row>
              <v-divider inset></v-divider>
            </div>
            <v-card-text
              ref="message"
              class="py-1 pb-2 pl-1"
              style="max-width:100%; overflow: hidden; white-space: pre-line;"
              v-html="decodeHtml(item.message)"
            ></v-card-text>
          </v-col>
        </v-row>
      </div>

      <v-card-text
        v-else
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
              v-for="(child, index) in this.item.children"
              :key="child.id"
              :item="child"
              :depth="depth + 1"
              @deleted="deleteMsg(index)"
            ></component>
          </v-container>
        </v-card>
      </v-slide-y-transition>
    </v-card>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "FeedItem",
  components: {},
  data: () => ({
    dialog: false,
    edit: false,
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
    deleteMsg(index) {
      if (
        typeof this.item.children != "undefined" &&
        typeof this.item.children[index] != "undefined" &&
        this.item.children[index].parentId != null
      ) {
        this.item.children.splice(index, 1);
        return;
      }
      this.dialog = false;
      this.$store
        .dispatch("DELETE_MESSAGE", {
          id: this.item.id
        })
        .then(() => {
          this.$emit("deleted");
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Deleted a message!",
            alertClass: "success"
          });
        });
    },
    childAction(data) {
      if (this.edit) {
        this.item.message = data.message;
        this.edit = false;
      } else {
        this.item.children = [...[data], ...this.item.children];
      }
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