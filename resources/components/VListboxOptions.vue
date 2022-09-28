<script lang="ts" setup>
import { ListboxOptions } from '@headlessui/vue';
</script>

<script lang="ts">
export default {
  inheritAttrs: false,
}
</script>

<template>
  <ListboxOptions as="ul" class="list-none absolute z-10 mt-1 bg-white dark:bg-gray-700 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 dark:ring-gray-400 dark:ring-opacity-10 overflow-auto focus:outline-none sm:text-sm">
    <slot></slot>
  </ListboxOptions>
</template>
