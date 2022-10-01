<script lang="ts">
  export default {
    inheritAttrs: false
  }
</script>

<script lang="ts" setup>
defineProps<{
  entry: Entry
}>()
</script>

<template>
  <div v-for="field in entry.fields">
    <component
      :is="taskday().field(field.type).component"
      :entry="entry"
      :value="entry.fields?.find((f) => f.id == field.id)?.value ?? ''"
      :field="field"
      v-bind="$attrs"
    ></component>
  </div>
</template>
