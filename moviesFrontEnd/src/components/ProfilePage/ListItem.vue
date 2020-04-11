<template>
  <v-layout class="fullRow caption font-weight-light" align-center style="height: 64px" row>
    <v-flex style="height:50px; margin-left: 2%; max-width: 4%">
      <v-img contain height="100%" :src="this.item.posterPath"></v-img>
    </v-flex>
    <!-- <v-card flat width="50px" height="50px">
      <v-img :src="this.item.posterPath"></v-img>
    </v-card>-->
    <v-col style="margin-left:1%; max-with:60%">{{ this.item.title }}</v-col>
    <v-icon
      style="margin-left: auto; margin-right:4%; max-width:3%"
      color="accent lighten-2"
      size="23"
      v-if="this.item.isFavorite == 1"
    >{{ this.likeIcon }}</v-icon>
    <v-icon
      style="margin-left: auto; margin-right:4%; max-width:3%"
      color="accent lighten-2"
      size="23"
      v-else
    >{{ this.nolikeIcon }}</v-icon>
    <v-col
      style="margin-left: auto; margin-right:0%; max-width:10%"
    >{{ this.moviesAddTypes[this.item.relationTypeId] }}</v-col>
    <v-col style="margin-left: 5%; margin-right:0%; max-width:6%">{{ this.item.rating }}</v-col>
    <v-container class="colorIndicator" :style="'background:' + getColor(item.rating)"></v-container>
  </v-layout>
</template>

<script>
export default {
  name: "ListItem",
  data: () => ({
    nolikeIcon: "mdi-heart-outline",
    likeIcon: "mdi-heart"
  }),
  props: {
    item: Object,
    moviesAddTypes: null
  },
  methods: {
    getColor(value) {
      //value from 0 to 1
      var hue = ((0 + (value - 1) / 10) * 100).toString(10);
      return ["hsl(", hue, ",80%,40%)"].join("");
    }
  }
};
</script>

<style scoped>
.fullRow {
  width: 100%;
}
.colorIndicator {
  border-radius: 50%;
  padding: 2px;
  margin: 0px;
  width: 20px;
  height: 20px;
}
</style>