<script lang="ts" setup>
import { PropType } from "vue";
import { useResource } from "@/composables/useResource";

let props = defineProps({
  entries: {
    type: Object as PropType<Pagination<Entry>>,
    required: true,
  },
});

const { data, loading, disabled, loadMore } = useResource<Entry>(
  route("api.entries.index"),
  props.entries
);
</script>

<template>
  <div class="space-y-4">
    <div v-for="entry in data.data" :key="entry.id">
      <Link class="hover:underline" :href="route('entries.show', entry)">
        {{ entry.title }}
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
