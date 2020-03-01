import Vue from "vue";
import Vuetify from "vuetify/lib";

Vue.use(Vuetify);

export default new Vuetify({
  icons: {
    iconfont: "md" // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4'
  },
  theme: {
    options: {
      customProperties: true
    },
    themes: {
      light: {
        primary: "#26395C",
        secondary: "#253247",
        accent: "#7C4DFF",
        error: "#B85188",
        warning: "#9CB021",
        success: "#2AA865",
        background: "#1F283B"   // rgba(12,16,23,0)
      },
      dark: {}
    }
  }
});
