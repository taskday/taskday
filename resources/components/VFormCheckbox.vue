<script lang="ts">
export default {
  inheritAttrs: false,
  customOptions: {},
  props: {
    errors: String,
    modelValue: String,
    label: {
      type: String,
      default: null,
    },
  },
};
</script>

<template>
  <label class="flex items-center">
    <span class="block mt-1">
      <input
        class="form-checkbox"
        type="checkbox"
        v-bind="$attrs"
        :value="modelValue"
        @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
      />
    </span>
    <span class="ml-2 block text-sm text-gray-700 dark:text-gray-200">{{ label }}</span>
    <p v-if="errors" class="mt-1 text-red-500 text-sm tracking-wide">{{ errors }}</p>
  </label>
</template>
