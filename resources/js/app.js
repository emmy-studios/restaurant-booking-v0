import './bootstrap';
 
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

// Vuetify
import vuetify from './Plugins/vuetify.js';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(vuetify)
      .mount(el)
  },
});