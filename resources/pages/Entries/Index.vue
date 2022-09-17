<script lang="ts" setup>
import { PropType } from "vue";
import { useResources } from "@/composables/useResources";
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
  entries: {
    type: Object as PropType<Pagination<Entry>>,
    required: true,
  },
  page: {
    type: Number,
    required: true,
  },
});

const form = useForm({ title: "" });

function submit() {
  form.post(route("entries.store"), {
    onSuccess: () => (form.title = ""),
  });
}
</script>

<template>
  <div class="space-y-4">
    <h1 class="text-2xl font-bold text-gray-900">
      {{ $page.props.title }}
    </h1>
    <form @submit.prevent="submit">
      <v-form-input
        type="text"
        placeholder="Something..."
        v-model="form.title"
      />
    </form>
    <div v-for="entry in entries.data" :key="entry.id">
      <Link class="hover:underline" :href="route('entries.show', entry)">
        <span v-html="entry.title"></span>
      </Link>
    </div>
  </div>
</template>
