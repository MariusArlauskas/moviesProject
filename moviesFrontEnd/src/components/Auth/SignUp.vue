<template>
  <v-container class="cont">
    <v-layout align-start justify-end>
      <v-flex xs12 sm8 md6 xl4>
        <v-form autocomplete="off">
          <v-card flat dark style="border-radius:40px" color="secondary">
            <v-toolbar flat color="transparent">
              <v-toolbar-title class="ml-5">Signup form</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <v-alert :value="userExists" color="error" icon="warning">This user alreary exists</v-alert>

              <v-text-field
                prepend-inner-icon="person"
                name="name"
                v-model="name"
                label="Username"
                :rules="[rules.required]"
              ></v-text-field>

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
                    name="birthDate"
                    v-model="birthDate"
                    label="Birthday date"
                    prepend-inner-icon="event"
                    readonly
                    v-on="on"
                    :rules="[rules.required]"
                  ></v-text-field>
                </template>
                <v-date-picker
                  ref="picker"
                  no-title
                  v-model="birthDate"
                  :max="new Date().toISOString().substr(0, 10)"
                  min="1950-01-01"
                  @change="saveBirthDate"
                  style="border-radius: 0px"
                ></v-date-picker>
              </v-menu>

              <v-text-field
                prepend-inner-icon="email"
                name="email"
                v-model="email"
                label="Email"
                :rules="[rules.required, rules.email]"
              ></v-text-field>

              <v-text-field
                prepend-inner-icon="lock"
                name="password"
                v-model="password"
                label="Password"
                autocomplete="new-password"
                :rules="[rules.required]"
                type="password"
              ></v-text-field>

              <v-text-field
                prepend-inner-icon="lock"
                name="password"
                label="Confirm Password"
                :rules="[rules.required]"
                type="password"
                v-model="confirm_password"
                :error="!valid()"
              ></v-text-field>
            </v-card-text>
            <v-card-actions class="mr-10 ml-10">
              <v-btn to="/login" depressed rounded color="transparent">Login</v-btn>
              <v-spacer></v-spacer>
              <v-btn depressed rounded color="transparent" @click="register()">
                Register
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
export default {
  name: "SignUp",
  data: () => ({
    menu: false,
    userExists: false,
    email: "",
    name: "",
    birthDate: null,
    password: "",
    confirm_password: "",
    rules: {
      required: value => !!value || "Required",
      email: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(value) || "Invalid e-mail.";
      }
    }
  }),
  methods: {
    register() {
      if (this.valid()) {
        this.$store
          .dispatch("REGISTER", {
            name: this.name,
            email: this.email,
            password: this.password,
            birthDate: this.birthDate
          })
          .then(() => {
            this.$store.commit("SET_NOTIFICATION", {
              display: true,
              text: "Account created! You can now login.",
              alertClass: "success"
            });
            this.$router.push("/login");
          })
          .catch(() => {
            this.userExists = true;
          });
      }
    },
    valid() {
      return this.password === this.confirm_password;
    },
    saveBirthDate(date) {
      this.$refs.menu.save(date);
    }
  },
  watch: {
    menu(val) {
      val && setTimeout(() => (this.$refs.picker.activePicker = "YEAR"));
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