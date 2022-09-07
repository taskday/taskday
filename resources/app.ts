import "@/css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/inertia-vue3";
import { createPinia } from 'pinia'

import AppLayout from '@/layouts/AppLayout.vue';

createInertiaApp({
    resolve: async (name) => {
        let [part1, part2] = name.split("/");

        if (part2 === undefined) {
            var page = (await import(`./pages/${part1}.vue`)).default;
        } else {
            var page = (await import(`./pages/${part1}/${part2}.vue`)).default;
        }

        if (page && !page.layout) {
            page.layout = AppLayout;
        }

        return page;
    },
    setup({ el, app, props, plugin }) {
        const pinia = createPinia()

        const instance = createApp({ render: () => h(app, props) });

        instance
            .use(plugin)
            .use(pinia)
            .mixin({ methods: { route } })
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
});
