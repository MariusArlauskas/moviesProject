<template>
  <v-card class="movieCard white--text mb-4">
    <v-card-title class="primary subtitle-1 py-2 text-no-wrap" style="height: 15%">
      <v-tooltip top>
        <template v-slot:activator="{ on }">
          <span
            style="overflow: hidden"
            class="font-weight-light"
            v-on="on"
          >{{ item.title }} (TODO only show hint if title long)</span>
        </template>
        <span>{{ item.title }}</span>
      </v-tooltip>
    </v-card-title>
    <v-layout style="height:85%; width:100%">
      <v-flex style="width:40%; cursor:pointer" @click.prevent="doSomething(item.id)" v-ripple>
        <v-img
          height="100%"
          :src="'https://image.tmdb.org/t/p/w600_and_h900_bestv2/'+item.poster_path"
        ></v-img>
      </v-flex>
      <v-flex outlined style="width:60%; height:100%">
        <v-card outlined flat dark style="width:100%; height:36%; background:transparent">
          <v-row class="mx-0 pt-3 pl-4">
            <v-col class="px-0 py-0 font-italic font-weight-regular white--text">Author (TODO)</v-col>
            <v-col
              class="px-0 py-0 font-italic font-weight-light white--text"
            >{{ item.release_date }}</v-col>
          </v-row>
          <v-row class="mx-0 pt-1 pl-4 caption">genreIds(TODO) {{ item.genre_ids }}</v-row>
        </v-card>

        <v-card-text
          class="desc white--text caption mt-4 pt-0 pl-4 pr-5"
          style="height:49%; overflow-y: scroll"
        >
          <div>{{ item.overview }}</div>
        </v-card-text>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    isActive: false
  }),
  props: {
    item: Object
  },
  methods: {
    doSomething(id) {
      console.log(id);
    }
  }
};
</script>

<style scoped>
.movieCard {
  margin-left: 0.5%;
  margin-right: 0.5%;
  background: var(--v-secondary-lighten1);
  max-width: 400px;
  max-height: 230px;
}
.bg {
  background: rgba(12, 16, 23, 0.5);
}
.desc::-webkit-scrollbar {
  display: none;
}
</style>