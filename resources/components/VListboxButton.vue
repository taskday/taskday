<script lang="ts" setup>
import {
  ListboxButton
} from '@headlessui/vue';
</script>

<template>
  <ListboxButton class="relative pl-3 pr-10 button button-secondary button-sm">
    <span class="flex items-center">
      <slot></slot>
    </span>
    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
      <VIcon name="chevron-down" class="h-5 w-5 text-gray-400" aria-hidden="true" />
    </span>
  </ListboxButton>
</template>
