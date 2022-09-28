<script lang="ts" setup>
import {
  ListboxButton
} from '@headlessui/vue';
</script>

<template>
  <ListboxButton class="relative w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-opacity-50 sm:text-sm">
    <span class="flex items-center">
      <slot></slot>
    </span>
    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
      <VIcon name="chevron-down" class="h-5 w-5 text-gray-400" aria-hidden="true" />
    </span>
  </ListboxButton>
</template>
