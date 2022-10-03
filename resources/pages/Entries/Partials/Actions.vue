<script lang="ts" setup>
import { useEntryStore } from '../useEntryStore';

let props = defineProps<{ entry: Entry }>();

const entryStore = useEntryStore();
</script>

<template>
  <div>
    <div class="mb-6 flex ittems-center gap-2">
      <v-button v-if="entryStore.isDirty" class="button button-primary" @click="entryStore.save(entry)">
        Save
      </v-button>
      <v-button-modal title="Delete this entry?" description="This operation is not reversable.">
        <v-button type="button" class="button-danger inline-flex"> Delete </v-button>
        <template #actions="{ open }">
          <v-button
            type="button"
            method="delete"
            :href="route('entries.destroy', props.entry)"
            class="button-danger inline-flex"
          >
            Delete
          </v-button>
        </template>
      </v-button-modal>
    </div>
  </div>
</template>
