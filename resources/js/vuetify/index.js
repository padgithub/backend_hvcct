/*import Vue from 'vue';
import Vuetify from "vuetify";

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#b0bec5',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
});*/

import Vue from 'vue'
import Vuetify from 'vuetify'
// import i18n from '@/i18n'

// import '@/sass/overrides.sass'

Vue.use(Vuetify)

const theme = {
    primary: '#4CAF50',
    secondary: '#9C27b0',
    accent: '#9C27b0',
    info: '#00CAE3',
}

export default new Vuetify({
    /*lang: {
        t: (key, ...params) => i18n.t(key, params),
    },*/
    theme: {
        themes: {
            dark: theme,
            light: theme,
        },
    },
    icons: {
        iconfont: 'mdi',
        values: {
            playListEdit: 'mdi-playlist-edit',
            delete: 'mdi-delete',
        },
    },
})

