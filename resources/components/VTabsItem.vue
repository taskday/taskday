<template>
  <Tab as="div" v-slot="{ selected }" class="button button-secondary">
    <button
      :class="[
        'text-sm leading-5 font-medium pb-px text-gray-700 inline-flex w-auto',
        'focus:outline-none ring-blue-500 ring-opacity-60',
        selected
          ? 'text-blue-600 dark:text-blue-300'
          : 'text-gray-900 dark:text-gray-300',
      ]"
    >
      <slot />
    </button>
  </Tab>
</template>

<script setup lang="ts">
import { Tab } from "@headlessui/vue";
</script>
