import { useForm } from "@inertiajs/inertia-vue3";
import { defineStore } from "pinia";

export const useEntryStore = defineStore("entry", {
  state: () => {
    return useForm({ title: "", content: "" });
  },
  actions: {
    update(title, content) {
      this.title = title;
      this.content = content;
    },
    save(entry) {
      console.log(entry);
      this.put(route("entries.update", entry));
    },
  },
});
