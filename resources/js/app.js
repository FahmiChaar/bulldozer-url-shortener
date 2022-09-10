import './bootstrap';
import '../css/app.css';
import 'vuetify/styles'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createVuetify } from 'vuetify'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import $bus from './events'
import vuetifyConfig from './vuetify.config';

const vuetify = createVuetify(vuetifyConfig)

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Bulldozer Url Shortener';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const vueApp = createApp({ render: () => h(app, props) })
        vueApp.config.globalProperties.$bus = $bus
        vueApp.use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vuetify)
            .use(VueSweetalert2)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#C18772' });
