<script lang="ts" setup>
import { createPopper, Instance } from "@popperjs/core";
import { onUnmounted, ref, watch } from "vue";

const popperInstance = ref<Instance>(null);
const popperRoot = ref<HTMLElement | null>(null);
const popperElement = ref<HTMLElement | null>(null);

watch(
  () => popperElement.value,
  () => {
    if (popperElement.value?.children.length > 0) {
      popperInstance.value = createPopper(popperRoot.value.el, popperElement.value, {
        placement: "bottom-start",
      });
    }
  }
);

onUnmounted(() => {
  setTimeout(() => {
    if (popperInstance.value) {
      popperInstance.value.destroy();
    }
  }, 100);
});

function setPopperRoot(el) {
  popperRoot.value = el;
}
function setPopperElement(el) {
  popperElement.value = el;
}
</script>

<template>
  <span ref="root">
    <slot :setPopperRoot="setPopperRoot" :setPopperElement="setPopperElement"></slot>
  </span>
</template>
