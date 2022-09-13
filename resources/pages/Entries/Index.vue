<script lang="ts" setup>
import { PropType } from "vue";
import { useResources } from "@/composables/useResources";

let props = defineProps({
  entries: {
    type: Object as PropType<Pagination<Entry>>,
    required: true,
  },
});

const { data, loading, disabled, loadMore } = useResources<Entry>(
  route("api.entries.index"),
  props.entries
);
</script>

<template>
  <div class="space-y-4">
    <h1 class="text-2xl font-bold text-gray-900">
      {{ $page.props.title }}
    </h1>
    <div v-for="entry in data.data" :key="entry.id">
      <Link class="hover:underline" :href="route('entries.show', entry)">
        <span v-html="entry.title"></span>
      </Link>
    </div>
    <v-button
      @click="loadMore"
      :disabled="disabled"
      :loading="loading"
      class="button-primary"
    >
      Load more
    </v-button>
  </div>
</template>
