<script lang="ts" setup>
import { ListboxOption } from "@headlessui/vue";
defineProps({
  value: String,
})
</script>

<template>
  <ListboxOption :value="value" as="template" v-slot="{ active, selected }">
    <li
      :class="[
        active
          ? 'text-gray-900 border border-indigo-600 dark:text-gray-300 dark:border-indigo-700 dark:border-opacity-80'
          : 'text-gray-900 dark:text-gray-300',
        'border border-transparent cursor-default select-none relative p-2',
      ]"
    >
      <slot :active="active" :selected="selected"></slot>
    </li>
  </ListboxOption>
</template>
