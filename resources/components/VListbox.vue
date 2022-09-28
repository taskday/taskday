<script lang="ts" setup>
import { Listbox } from "@headlessui/vue";
import { ref, watch } from "vue";

let emit = defineEmits(['update:modelValue']);

let props = defineProps({
  modelValue: { type: String, required: false },
});

const value = ref(props.modelValue ?? "");

watch(() => value.value, () => emit('update:modelValue', value.value))
</script>

<template>
  <Listbox as="div" v-model="value">
    <slot></slot>
  </Listbox>
</template>
