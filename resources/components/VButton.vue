<template>
  <Link
    v-if="href"
    :href="href"
    class="flex items-center justify-center text-sm transition whitespace-nowrap button"
    v-bind="$attrs"
    :disabled="disabled"
  >
    <slot></slot>
  </Link>
  <button
    v-else
    class="flex items-center justify-center text-sm transition whitespace-nowrap button"
    v-bind="$attrs"
    :disabled="disabled"
  >
    <template v-if="loading">
      <svg class="w-5 h-5 mr-3 -ml-1 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
    </template>
    <slot></slot>
  </button>
</template>

<script lang="ts">
import { defineComponent, PropType } from "vue";
export default defineComponent({
  inheritAttrs: false,
  computed: {
    tag(): string {
      return this.href ? "a" : "button";
    }
  },
  props: {
    href: {
      type: String,
      default: null,
    },
    type: {
      type: String as PropType<"button" | "a" | "submit">,
      default: "button",
    },
    loading: {
      type: Boolean,
      default: false,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
});
</script>
