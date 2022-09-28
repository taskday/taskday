<script lang="ts" setup>
defineProps<{ entry: Entry }>();
</script>

<template>
  <div class="mt-6 space-y-8 border-t border-b border-gray-200 py-6">
    <div v-for="field in entry.board.fields">
      <component
        :is="taskday().field(field.type).component"
        :entry="entry"
        :value="entry.fields.find((f) => f.id == field.id).value"
        :field="field"
      ></component>
    </div>
  </div>
</template>
