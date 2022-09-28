<script lang="ts" setup>
import { PropType } from "vue";
import Create from "./Forms/Create.vue";

defineProps({
  entries: {
    type: Object as PropType<Pagination<Entry>>,
    required: true,
  },
  page: {
    type: Number,
    required: true,
  },
});
</script>

<template>
  <div class="space-y-4">
    <h1 class="text-2xl font-bold text-gray-900">
      {{ $page.props.title }}
    </h1>
    <div v-if="entries.data.length > 0">
      <div v-for="entry in entries.data" :key="entry.id">
        <Link class="hover:underline" :href="route('entries.show', entry)">
          <span v-html="entry.title"></span>
        </Link>
      </div>
    </div>
    <div v-else>
      <div class="text-gray-600">
        <p>No entries here :(</p>
        <p>Create a board to get started!</p>
      </div>
    </div>
  </div>
</template>
