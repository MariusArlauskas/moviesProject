<template>
  <v-layout
    class="fullRow caption font-weight-light mx-0"
    align-center
    style="height: 50px; width:100%; cursor:pointer"
    row
  >
    <v-avatar style="height:30px; margin-left: 20px; max-width: 30px; min-width:30px">
      <img :src="this.item.profilePicture" />
    </v-avatar>
    <v-col
      class="text-no-wrap"
      style="margin-left:1%; max-width:15%; min-width:15%; overflow-x: hidden"
    >{{ this.item.name }}</v-col>
    <v-col
      class="text-no-wrap"
      style="margin-left:1%; max-width:30%; min-width:30%; overflow-x: hidden"
    >{{ this.item.email }}</v-col>
    <v-col
      class="text-no-wrap"
      style="margin-left:1%; max-width:15%; min-width:15%"
    >{{ this.item.registerDate }}</v-col>
    <!-- 
    <v-container
      class="colorIndicator"
      :style="'margin-right:1%; background:' + getColor(item.rating)"
    ></v-container>
    -->
  </v-layout>
</template>

<script>
export default {
  name: "UserItem",
  components: {},
  data: () => ({}),
  props: {
    item: Object
  },
  methods: {}
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