<script lang="ts">
export default {
  inheritAttrs: false,
};
</script>

<script lang="ts" setup>
import { MenuItem } from "@headlessui/vue";

defineProps({
  as: {
    type: String,
    default: "Link",
  },
});
</script>

<template>
  <MenuItem v-slot="{ active, selected }">
    <component
      :is="as"
      :class="{ 'bg-gray-100': active }"
      class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2"
      v-bind="$attrs"
    >
      <slot></slot>
    </component>
  </MenuItem>
</template>
