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
        primary: "#283593",         //  rgba(40, 53, 147, 0.5)
        primaryDark: "#1A237E",     //  rgba(26, 35, 126, 0.5)
        primaryLight: "#8C9EFF",    //  rgba(140, 158, 255, 0.5)
        secondary: "#4527A0",       //  rgba(69, 39, 160, 0.5)
        secondaryDark: "#311B92",   //  rgba(49, 27, 146, 0.5)
        secondaryLight: "#B388FF",  //  rgba(179, 136, 255, 0.5)
        accent: "#7C4DFF",          //  rgba(124, 77, 255, 0.5)
        accentLight: "#8C9EFF",     //  rgba(140, 158, 255, 0.5)
        darkBackgroud: "#C5CAE9",   //  rgba(197, 202, 233, 0.5)
        error: "#F50057",           //  rgba(245, 0, 87, 0.5)
        warning: "#C6FF00",         //  rgba(198, 255, 0, 0.5)
        success: "#1DE9B6",         //  rgba(29, 233, 182, 0.5)
        background: "#FAFAFA"       //  rgba(250, 250, 250, 0.5)
      },
      dark: {}
    }
  }
});
