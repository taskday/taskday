<script lang="ts" setup>
import { Inertia } from "@inertiajs/inertia";
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
  filters: {
    type: Array,
    required: true,
  },
  query: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="space-y-4">
    <v-title>
      {{ $page.props.title }}
    </v-title>
    <div>
      <v-menu>
        <v-button class="button-secondary button-sm">
          <v-icon name="sliders" class="h-4 w-4"></v-icon>
        </v-button>
        <template #content>
          <v-menu-item as="Link" v-for="filter in filters" method="post" :href="route('filters.store')" :data="{ 
            'type': filter.type,
            'operator': filter.operators[0],
           }">
            {{ filter.type }}
          </v-menu-item>
        </template>
      </v-menu>
      <div v-for="filter in query.filters">
        <v-filter :filter="filter"></v-filter>
      </div>
    </div>
    <div v-if="entries.data.length > 0">
      <div v-for="entry in entries.data" :key="entry.id">
        <v-card class="flex flex-col gap-3">
          <v-breadcrumbs :pages="[{ name: entry.board.title, url: route('boards.show', entry.board) }]" />
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
