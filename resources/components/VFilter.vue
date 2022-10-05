<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia';
import { watch } from 'vue';

const props = defineProps<{ filter: any }>();

watch(() => props.filter.operator, (value) => {
  Inertia.put(route('filters.update', props.filter), {
    value: props.filter.value,
    operator: value,
  })
})

function destroy() {
  Inertia.delete(route('filters.destroy', props.filter))
}
</script>

<template>
  <legend :title="filter.name">
    <span class="h-7 rounded flex items-center gap-1 relative mt-4">
      <VFormSelect v-if="filter.columns?.length > 0" v-model="filter.column">
        <option v-for="column in filter.columns" :value="column.handle">
          {{ column.title }}
        </option>
      </VFormSelect>
      <VFormSelect v-model="filter.operator">
        <option v-for="op in filter.operators" :value="op">
          {{ op }}
        </option>
      </VFormSelect>
      <component
        v-if="filter.operator != 'present'"
        :is="taskday().filter(filter.type).component"
        :filter="filter"
        v-model:column="filter.column"
        v-model:value="filter.value"
      ></component>
      <VButton @click="destroy">&times;</VButton>
    </span>
  </legend>
</template>
