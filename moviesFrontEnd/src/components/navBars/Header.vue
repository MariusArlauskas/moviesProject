<template>
  <div>
    <v-fade-transition>
      <v-navigation-drawer
        class="hidden-sm-and-down"
        width="100%"
        height="auto"
        dark
        color="var(--v-primary-base)"
        style="padding-left: 0px"
        permanent
        fixed
        v-show="showNavbar"
      >
        <v-toolbar-title style="width: 180px; float: left;" class="noScrollbar ml-3 mr-10">
          <router-link :to="{ name: 'HomePage' }">
            <v-row class="ml-0 my-2" align="center">
              <v-avatar size="35px" color="var(--v-primary-lighten5)" class="mr-2">
                <v-img contain max-height="33px" max-width="33px" src="../../assets/logo.png"></v-img>
              </v-avatar>
              <v-content class="py-0 white--text">{{ GET_WEB_TITLE }}</v-content>
            </v-row>
          </router-link>
        </v-toolbar-title>

        <v-toolbar-items
          style="float: left; height: auto"
          v-for="link in links"
          :key="link.name"
          class="font-weight-light mr-3 header-href"
        >
          <router-link :class="link.classes" :to="{ name: link.href }">{{ link.name }}</router-link>
        </v-toolbar-items>

        <SearchDialog />
      </v-navigation-drawer>
    </v-fade-transition>

    <v-fade-transition>
      <v-card
        class="hidden-md-and-up mx-auto overflow-hidden primary"
        style="border-radius: 0%"
        height="auto"
        width="100%"
      >
        <v-app-bar color="primary" max-height="100px" dark prominent>
          <v-layout wrap>
            <v-row style="width:100%">
              <v-app-bar-nav-icon @click="changeBar()"></v-app-bar-nav-icon>
              <div style="margin-left: auto; margin-right:2%;">
                <SearchDialog />
              </div>
              <v-app-bar-nav-icon
                v-if="GET_USER.id"
                style="margin-right:60px"
                @click="changeProfileBar(true)"
              ></v-app-bar-nav-icon>
            </v-row>
            <v-row style="width:100%">
              <v-toolbar-title style="width: 100%" class="noScrollbar">
                <router-link :to="{ name: 'HomePage' }">
                  <v-col class="py-0" align="center">
                    <v-content class="py-0 white--text">{{ GET_WEB_TITLE }}</v-content>
                  </v-col>
                </router-link>
              </v-toolbar-title>
            </v-row>
          </v-layout>
        </v-app-bar>

        <v-navigation-drawer
          class="pb-3"
          dark
          color="var(--v-primary-base)"
          temporary
          fixed
          width="180px"
          v-model="navbar"
        >
          <v-content class="py-4 white--text title text-center">{{ GET_WEB_TITLE }}</v-content>
          <v-divider></v-divider>
          <v-list-item-group>
            <v-list-item
              v-for="(link, index) in links"
              :key="index"
              class="font-weight-light mr-3 header-href"
              @click="jump(link.href)"
              link
              dense
            >
              <v-list-item-icon>
                <v-icon>{{ link.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title :class="link.classes">{{ link.name }}</v-list-item-title>
            </v-list-item>
          </v-list-item-group>
        </v-navigation-drawer>
      </v-card>
    </v-fade-transition>
  </div>
</template>

<script>
import SearchDialog from "../SearchDialog";
import { mapGetters } from "vuex";
export default {
  name: "Header",
  components: { SearchDialog },
  data: () => {
    return {
      navbar: false,
      showNavbar: true,
      lastScrollPosition: 0
    };
  },
  computed: {
    ...mapGetters(["GET_WEB_TITLE", "GET_USER"]),
    links: {
      get() {
        let array = this.$store.getters.GET_HEADER_LINKS;
        if (this.$store.getters.GET_USER) {
          return array.filter(function(e) {
            return e.showWhenLoggedIn == true;
          });
        } else {
          return array;
        }
      },
      set() {}
    }
  },
  methods: {
    jump(routeName) {
      if (this.$route.name != routeName) {
        this.$router.push({ name: routeName });
      }
    },
    changeBar() {
      this.navbar = !this.navbar;
    },
    changeProfileBar() {
      this.$store.commit("SET_DRAWER");
    },
    onScroll() {
      const currentScrollPosition =
        window.pageYOffset || document.documentElement.scrollTop;
      // Because of momentum scrolling on mobiles, we shouldn't continue if it is less than zero
      if (currentScrollPosition < 0) {
        return;
      }
      if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 60) {
        return;
      }
      this.showNavbar = currentScrollPosition < this.lastScrollPosition;
      this.lastScrollPosition = currentScrollPosition;
    }
  },
  mounted() {
    window.addEventListener("scroll", this.onScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  }
};
</script>

<style scoped>
div a {
  text-decoration: none;
}
.header-href {
  margin-top: 13.5px;
}
.search {
  margin-right: 15%;
}
</style>
