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
    <v-title>
      {{ $page.props.title }}
    </v-title>
    <div v-if="entries.data.length > 0">
      <div v-for="entry in entries.data" :key="entry.id">
        <v-card class="flex flex-col gap-3">
          <v-breadcrumbs
            :pages="[
              { name: entry.board.title, url: route('boards.show', entry.board) },
            ]"
          />
          <Link class="hover:underline" :href="route('entries.show', entry)">
            <span v-html="entry.title"></span>
          </Link>
          <div class="flex items-center gap-2">
            <v-entry-fields :readonly="true" :entry="entry" />
          </div>
        </v-card>
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
