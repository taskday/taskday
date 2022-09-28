<template>
  <TabGroup :selectedIndex="index" @change="change">
    <slot />
  </TabGroup>
</template>

<script setup lang="ts">
import { TabGroup } from "@headlessui/vue";
import { ref } from 'vue';

const index = ref((function () {
  return parseInt(localStorage.getItem(location.href))
})());

function change(e) {
  index.value = e;
  localStorage.setItem(location.href, e)
}
</script>
