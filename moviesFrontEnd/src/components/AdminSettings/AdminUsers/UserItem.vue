<template>
  <v-layout
    class="fullRow caption font-weight-light mx-0"
    align-center
    style="height: 55px; width:100%; cursor:pointer"
    row
    @click="jump()"
  >
    <v-avatar style="height:30px; margin-left: 20px; max-width: 30px; min-width:30px">
      <img :src="this.item.profilePicture" />
    </v-avatar>
    <v-col
      class="text-no-wrap"
      style="max-width:15%; min-width:15%; overflow-x: hidden"
    >{{ this.item.name }}</v-col>
    <v-col
      class="text-no-wrap"
      style="margin-left:1%; max-width:30%; min-width:30%; overflow-x: hidden"
    >{{ this.item.email }}</v-col>
    <v-col
      class="text-no-wrap"
      style="margin-left:1%; max-width:15%; min-width:15%"
    >{{ this.item.registerDate }}</v-col>
    <v-col
      v-on:click.stop
      class="text-no-wrap pb-0"
      style="margin-left:1%; max-width:13%; min-width:13%"
    >
      <v-select
        height="20px"
        class="caption"
        dense
        :items="roles"
        v-model="chosenRole"
        item-text="name"
        item-value="realName"
        @change="changeUserRole"
      ></v-select>
    </v-col>
    <v-col
      v-on:click.stop
      class="text-no-wrap pb-0 pt-4"
      style="margin-left:2%; max-width:11%; min-width:11%"
    >
      <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-text-field
            height="20px"
            class="pb-0 pt-1 my-0 caption"
            name="chatBannedUntil"
            v-model="chatBannedUntil"
            readonly
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          ref="picker"
          no-title
          v-model="chatBannedUntil"
          min="2000-01-01"
          :max="getMaxDate"
          @change="saveChatBannedUntil"
          style="border-radius: 0px"
        ></v-date-picker>
      </v-menu>
    </v-col>
    <v-container
      v-show="this.item.chatBannedUntil != ''"
      class="colorIndicator"
      :style="'margin-right:1%; background:' + [new Date(this.item.chatBannedUntil) > new Date() ? 'var(--v-error-darken1);' : 'var(--v-success-base);']"
    ></v-container>
  </v-layout>
</template>

<script>
export default {
  name: "UserItem",
  components: {},
  data: () => ({
    menu: false,
    chatBannedUntil: null,
    roles: [
      { name: "User", realName: "ROLE_USER" },
      { name: "Admin", realName: "ROLE_ADMIN" }
    ],
    chosenRole: ""
  }),
  props: {
    item: Object
  },
  computed: {
    getMaxDate() {
      var d = new Date();
      d.setFullYear(d.getFullYear() + 10);
      return d.toISOString().substr(0, 10);
    }
  },
  methods: {
    jump() {
      this.$router.push({
        name: "ProfileMainWall",
        params: { id: this.item.id }
      });
    },
    changeUserRole() {
      this.$store
        .dispatch("CHANGE_USER_ROLE", {
          id: this.item.id,
          role: this.chosenRole
        })
        .then(() => {
          this.item.role = this.chosenRole;
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: this.item.name + " role got changed!",
            alertClass: "success"
          });
        });
    },
    saveChatBannedUntil(date) {
      this.$refs.menu.save(date);
      this.$store
        .dispatch("CHAT_BAN_USER", {
          id: this.item.id,
          chatBannedUntil: date
        })
        .then(() => {
          this.item.chatBannedUntil = date;
          this.item.role = this.chosenRole;
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: this.item.name + " got chat banned until " + date + " !",
            alertClass: "success"
          });
        });
    }
  },
  mounted() {
    this.chosenRole = this.item.role;
    this.chatBannedUntil = this.item.chatBannedUntil;
  },
  watch: {
    menu(val) {
      val && setTimeout(() => (this.$refs.picker.activePicker = "YEAR"));
    }
  }
};
</script>

<style scoped>
.fullRow {
  width: 100%;
}
.fullRow:hover {
  background-color: var(--v-background-lighten1);
}
.colorIndicator {
  border-radius: 50%;
  padding: 2px;
  margin: 0px;
  width: 20px;
  height: 20px;
}
</style>