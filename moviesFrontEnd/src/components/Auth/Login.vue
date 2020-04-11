<template>
  <v-container class="cont">
    <v-layout align-start justify-end>
      <v-flex xs12 sm8 md6 xl4>
        <v-form>
          <v-card flat dark style="border-radius:40px" color="secondary">
            <v-toolbar flat color="transparent">
              <v-toolbar-title class="ml-5">Login form</v-toolbar-title>
            </v-toolbar>
            <v-alert
              class="ml-7 mr-7"
              color="error"
              :value="error"
              icon="close"
            >The username or password is incorrect!</v-alert>

            <v-card-text class="justify-center">
              <v-text-field
                v-model="username"
                prepend-inner-icon="person"
                name="username"
                label="E-mail"
                type="text"
                v-on:keyup.enter="login()"
              ></v-text-field>

              <v-text-field
                v-model="password"
                prepend-inner-icon="lock"
                name="password"
                label="Password"
                type="password"
                v-on:keyup.enter="login()"
              ></v-text-field>
            </v-card-text>
            <v-card-actions class="mr-10 ml-10">
              <v-btn to="/signUp" depressed rounded color="transparent">Sign up</v-btn>
              <v-spacer></v-spacer>
              <v-btn
                :loading="this.loginLoad"
                depressed
                rounded
                color="transparent"
                @click="login()"
              >
                Login
                <v-icon>keyboard_arrow_right</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
// import Notification from "../Notification";
export default {
  name: "login",
  // components: { Notification },
  data: () => ({
    username: "",
    password: "",
    error: false,
    loginLoad: false
  }),
  methods: {
    login() {
      this.loginLoad = true;
      this.$store
        .dispatch("LOGIN", {
          username: this.username,
          password: this.password
        })
        .then(() => {
          this.$router.push("/");
          this.$store
            .commit("SET_NOTIFICATION", {
              display: true,
              text: "Logged in!",
              alertClass: "success"
            })
            .catch(() => {
              this.error = true;
            });
        })
        .catch(() => {
          this.loginLoad = false;
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
.cont {
  margin-top: 2%;
  margin-right: 6%;
}
</style>
