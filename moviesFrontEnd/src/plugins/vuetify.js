import Vue from 'vue';
import Vuetify, { colors } from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
icons: {
    iconfont: 'md',  // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4'
    },
    theme: {
    options: {
        customProperties: true,
    },
    themes: {
        light: {
        primary: '#300377',
        primaryDark: '#1E0D51',
        secondary: '#4E38B7',
        accent: '#457AD1',
        accentLight: '#79A7E0',
        darkBackgroud: '#070014',
        error: '#ff0066',
        background: '#f2f2f2',
        },
        dark: {
        primary: colors.blue,
        secondary: colors.purple,
        accent: '#db4df7',
        error: '#ff0066',
        background: '#00000',
        },
    },
    },
});
