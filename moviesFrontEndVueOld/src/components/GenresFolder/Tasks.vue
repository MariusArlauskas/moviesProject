<template>
  <div style="height: 100%">
    <v-card style="height: 100%; overflow: hidden">
      <v-toolbar color="blue" dark>
        <v-toolbar-title style="font-family: 'Carter One', cursive;">{{ currentGenre["name"] }}</v-toolbar-title>
      </v-toolbar>

      <v-container style="height: 30%" class="ml-5 mr-5">
        <v-row>
          <v-col cols="7">
            <v-row>
              <v-content style="font-family: 'Carter One', cursive;">{{ currentGenre["name"] }}</v-content>
            </v-row>
          </v-col>
          <v-col cols="1">
            <v-btn v-if="ROLE === 'ROLE_ADMIN'" @click.prevent="openEditModal" color="primary" icon>
              <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
            </v-btn>
          </v-col>
          <v-col cols="1">
            <v-btn v-if="ROLE === 'ROLE_ADMIN'" @click.prevent="deleteGenre" cols="1" icon color="pink">
              <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
            </v-btn>
          </v-col>
        </v-row>
        <v-row
          style="width: 98%; max-height: 70%; height: 70%; overflow-y: scroll; font-family: 'Courgette', cursive;"
        >{{ currentGenre["description"] }}</v-row>
      </v-container>
      <v-content class="pl-5 title">Movie list</v-content>
      <v-divider></v-divider>
      <v-list two-line style="height: 59%; overflow-y: scroll">
        <template v-for="(task, key) in TASKS">
          <Task v-bind:key="key" :task="task"/>
        </template>
      </v-list>
    </v-card>
    <router-view name="genresEdit"></router-view>
    <router-view name="genreMovieInfoModal"></router-view>
  </div>
</template>

<script>
import Task from "./Task";
export default {
  name: "tasks",
  components: { Task },
  data: () => ({}),
  methods: {
    openEditModal() {
      this.$router.push({
        name: "genresEdit"
      });
    },
    async deleteGenre() {
      await this.$store
        .dispatch("DELETE_GENRE", {
          genreId: this.$route.params.id
        })
        .then(() => {
          this.$store.commit("SET_NOTIFICATION", {
            display: true,
            text: "Genre has been removed!",
            alertClass: "warning"
          })
          this.$store.dispatch("GET_LISTS")
          this.$router.push({
            name: "todo"
          });
        })
    }
  },
  computed: {
    currentGenre() {
      return this.$store.getters.LIST(this.$route.params.id);
    },
    TASKS() {
      return this.$store.getters.TASKS(this.$route.params.id);
    },
    ROLE() {
      return this.$store.getters.ROLE;
    }
  },
  async mounted() {
    await this.$store.dispatch("GET_TASKS", this.$route.params.id);
  }
};
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Carter+One&display=swap');
@import url('https://fonts.googleapis.com/css?family=Courgette&display=swap');
</style>