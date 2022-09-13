<script lang="ts" setup>
defineProps<{ entry: Entry }>()
</script>

<template>
  <div>
    <h2 class="sr-only">Details</h2>
    <div class="space-y-5">
      <div class="flex items-center space-x-2">
        <v-icon
          name="message-circle"
          class="h-5 w-5 text-gray-400"
          aria-hidden="true"
        />
        <span class="text-sm font-medium text-gray-900">
          {{ entry.comments_count ?? 0 }} comments
        </span>
      </div>
      <div class="flex items-center space-x-2">
        <v-icon
          name="calendar"
          class="h-5 w-5 text-gray-400"
          aria-hidden="true"
        />
        <span class="text-sm font-medium text-gray-900">
          Created on <time :datetime="entry.created_at"> {{ entry.created_at }} </time>
        </span>
      </div>
    </div>
  </div>
</template>
