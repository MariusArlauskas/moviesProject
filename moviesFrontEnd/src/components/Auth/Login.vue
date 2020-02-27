<template>
  <v-container class="mt-5 mr-10">
    <v-layout align-start justify-end>
      <v-flex xs12 sm8 md6 xl4>
        <v-form>
          <v-card flat dark style="border-radius:50px" color="rgb(255, 255, 255, 0.1)">
            <v-toolbar flat color="rgba(69, 39, 160, 0)">
              <v-toolbar-title class="ml-5">Login form</v-toolbar-title>
            </v-toolbar>
            <!-- <v-alert color="error" :value="error" icon="close"
              >The username or password are incorrect!</v-alert
            >-->

            <v-card-text class="justify-center">
              <v-text-field
                v-model="username"
                prepend-inner-icon="person"
                name="username"
                label="Login"
                type="text"
              ></v-text-field>

              <v-text-field
                v-model="password"
                prepend-inner-icon="lock"
                name="password"
                label="Password"
                type="password"
              ></v-text-field>
            </v-card-text>
            <v-card-actions class="mr-10 ml-10">
              <v-btn to="/signup" depressed rounded color="rgba(69, 39, 160, 0)">Sign up</v-btn>
              <v-spacer></v-spacer>
              <v-btn depressed rounded color="rgba(69, 39, 160, 0)" @click.prevent="login()">
                Login
                <v-icon>keyboard_arrow_right</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
  <!-- <Notification /> -->
</template>

<script>
// import Notification from "../Notification";
export default {
  name: "login",
  // components: { Notification },
  data: () => ({
    username: "",
    password: "",
    error: false
  }),
  methods: {
    login() {
      this.$store
        .dispatch("LOGIN", {
          username: this.username,
          password: this.password
        })
        .then(() => {
          this.$router.push("/");
          // this.$store
          //   .dispatch("SET_ROLE")
          //   .then(() => {
          //     this.$router.push("/");
          //     this.$store.commit("SET_NOTIFICATION", {
          //       display: true,
          //       text: "Logged in!",
          //       alertClass: "success"
          //     });
          //   })
          //   .catch(() => {
          //     this.error = true;
          //   });
        })
        .catch(() => {
          this.error = true;
        });
    }
  }
};
</script>

<style scoped>
.v-text-field {
  width: 70%;
  margin-left: auto;
  margin-right: auto;
}

.v-text-field .v-icon {
  color: var(--v-secondary-base);
}
</style>
