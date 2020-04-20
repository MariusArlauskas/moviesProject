<template>
  <v-card class="background lighten-1 py-1 px-1" flat dark>
    <v-layout class="background mx-0 px-7 pb-2" column>
      <v-form autocomplete="off">
        <v-card class="transparent" flat>
          <v-toolbar flat color="transparent">
            <v-row class="fullRow title" justify="center">Edit profile</v-row>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text>
            <v-alert v-if="error.show" color="error" icon="warning">{{ error.message }}</v-alert>

            <v-row align="center">
              <v-col style="width:40%; margin-right: 8%">
                <v-row>
                  <v-text-field
                    ref="name"
                    name="name"
                    v-model="this.user.name"
                    maxlength="100"
                    hint="User name, which is shown to all users"
                    persistent-hint
                    counter
                  ></v-text-field>
                </v-row>
              </v-col>
              <v-col style="width:30%; margin-right: 2%">
                <v-row>
                  <v-file-input
                    name="image"
                    v-model="image"
                    hint="Profile image"
                    persistent-hint
                    prepend-icon="account_box"
                    accept="image/png, image/jpeg, image/jpg"
                    @change="onFileChange"
                  ></v-file-input>
                </v-row>
              </v-col>
              <v-col class="px-0" style="max-width:20%">
                <v-img v-if="this.imageUrl != ''" contain max-height="100px" :src="this.imageUrl"></v-img>
                <v-img v-else contain max-height="100px" :src="this.user.profilePicture"></v-img>
              </v-col>
            </v-row>

            <v-row class="pb-10" style="width:100%">
              <v-textarea
                rows="6"
                no-resize
                name="description"
                v-model="user.description"
                hint="Your self description"
                persistent-hint
                clearable
              ></v-textarea>
            </v-row>

            <v-row class="fullRow subtitle-1" justify="center">Change password</v-row>
            <v-row style="width:50%;">
              <v-text-field
                name="password"
                v-model="password"
                type="password"
                hint="Current password"
                persistent-hint
              ></v-text-field>
            </v-row>
            <v-row style="width:100%;">
              <v-col class="px-0" style="width:49%; margin-right:2%">
                <v-text-field
                  name="password"
                  v-model="password"
                  type="password"
                  hint="New password"
                  persistent-hint
                ></v-text-field>
              </v-col>
              <v-col class="px-0" style="width:49%;">
                <v-text-field
                  name="password"
                  type="password"
                  v-model="confirm_password"
                  autocomplete="new-password"
                  hint="Repeat new password"
                  persistent-hint
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              :loading="this.loading"
              depressed
              outlined
              color="accent lighten-2"
              @click="save()"
            >
              Save
              <v-icon>keyboard_arrow_right</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  name: "ProfileEditProfile",
  data: () => ({
    imageUrl: "",
    image: [],
    password: "",
    confirm_password: "",
    error: {
      show: false,
      message: ""
    },
    loading: false
  }),
  props: {
    user: Object
  },
  methods: {
    onFileChange(e) {
      try {
        this.imageUrl = URL.createObjectURL(e);
      } catch (err) {
        // Do nothing
      }
    },
    save() {
      if (this.valid()) {
        this.loading = true;

        this.$store
          .dispatch("UPDATE_USER", {
            id: this.user.id,
            name: this.user.name,
            description: this.user.description,
            password: this.password
          })
          .then(() => {
            if (this.imageUrl != "") {
              var formData = new FormData();
              formData.append("profilePicture", this.image);
              this.$store
                .dispatch("UPLOAD_USER_PICTURE", [this.user.id, formData])
                .then(() => {
                  this.$store.commit("SET_NOTIFICATION", {
                    display: true,
                    text: "Your profile was updated!",
                    alertClass: "success"
                  });
                  this.$router.push({
                    name: "ProfileMainWall",
                    params: { id: this.user.id }
                  });
                })
                .catch(() => {
                  this.userExists = true;
                  this.loading = false;
                });
            } else {
              this.$store.commit("SET_NOTIFICATION", {
                display: true,
                text: "Your profile was updated!",
                alertClass: "success"
              });
              this.$router.push({
                name: "ProfileMainWall",
                params: { id: this.user.id }
              });
            }
          })
          .catch(() => {
            this.userExists = true;
            this.loading = false;
          });
      } else {
        this.error.show = true;
        this.error.message = "Passwords do not match!";
      }
    },
    valid() {
      return this.password === this.confirm_password;
    }
  },
  mounted() {
    this.name = this.user.name;
    this.description = this.user.description;
  }
};
</script>

<style scoped>
</style>