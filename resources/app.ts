import './bootstrap';

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/inertia-vue3";
import { createPinia } from "pinia";
import Taskday from "@/plugins/index";

import "@/plugins/example/index";

import AppLayout from "@/layouts/AppLayout.vue";
import ActivityCommented from "@/pages/Entries/Activities/Commented.vue";
import ActivityCreated from "@/pages/Entries/Activities/Created.vue";
import ActivityUpdated from "@/pages/Entries/Activities/Updated.vue";
import ActivityFieldCreated from "@/pages/Entries/Activities/FieldCreated.vue";
import ActivityFieldUpdated from "@/pages/Entries/Activities/FieldUpdated.vue";

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
    const pinia = createPinia();

    const instance = createApp({
      render: () => h(app, props),
    });

    instance
      .use(Taskday)
      .use(plugin)
      .use(pinia)
      .mixin({ methods: { route } })
      .component("Link", Link)
      .component("Head", Head)
      .component("activities-commented", ActivityCommented)
      .component("activities-created", ActivityCreated)
      .component("activities-updated", ActivityUpdated)
      .component("activities-field-created", ActivityFieldCreated)
      .component("activities-field-updated", ActivityFieldUpdated)
      .mount(el);
  },
});
