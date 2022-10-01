<script lang="ts" setup>
defineProps<{ widget: any }>();
</script>

<template>
  <div>
    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
      <component 
        :is="taskday().widget(widget.type).component"
        :widget="widget"
      ></component>
    </div>
  </div>
</template>
