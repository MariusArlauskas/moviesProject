<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn text rounded class="mt-2 search float-right" v-on="on">
        Search
        <v-icon>search</v-icon>
      </v-btn>
    </template>

    <v-card
      style="border-radius:25px; position: absolute; top:10%; left:35%"
      width="30%"
      color="secondary lighten-1"
    >
      <v-form @submit.prevent="searchRecord()">
        <v-text-field
          style="overflow: hidden"
          prepend-inner-icon="search"
          dark
          hint="search"
          placeholder="Search for a record"
          dense
          hide-details
          clearable
          rounded
          outlined
          v-model="title"
          autofocus
        ></v-text-field>
      </v-form>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "SearchDialog",
  data: () => ({
    dialog: false,
    title: "",
    recordsFound: []
  }),
  methods: {
    searchRecord() {
      this.$store.dispatch("FIND_MOVIE", this.title).then(data => {
        console.log(data.results);
      });
    }
  }
};
</script>

<style scoped>
.search {
  margin-right: 15%;
}
</style>