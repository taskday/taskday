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
  <label class="block">
    <span class="block text-sm font-medium text-gray-700">{{ label }}</span>
    <span class="block mt-1">
      <input
        class="form-input"
        v-bind="$attrs"
        :value="modelValue"
        @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
      />
    </span>
    <p v-if="errors" class="mt-1 text-red-500 text-sm tracking-wide">{{ errors }}</p>
  </label>
</template>
