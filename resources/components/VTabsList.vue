<template>
  <div class="">
    <TabList class="flex gap-4">
      <slot />
    </TabList>
  </div>
</template>

<script setup lang="ts">
import { TabList } from '@headlessui/vue'
</script>
