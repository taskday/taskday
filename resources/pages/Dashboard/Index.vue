<script lang="ts" setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps<{ widgets: any[] }>();

const newWidget = useForm({
  type: '',
})

function storeNewWidget() {
  newWidget.post(route('widgets.store'), {
    onSuccess: () => newWidget.reset(),
    preserveScroll: true,
  })
}
</script>

<template>
  <v-modal title="Add a widget">
    <v-button class="button-secondary button-sm">
      <v-icon name="plus" class="h-4"></v-icon>
      <span>Widget</span>
    </v-button>
    <template #content>
      <div class="w-full space-y-4">
        <p class="w-full text-gray-800 p-1 text-sm flex items-center gap-2 bg-gray-50 border rounded-sm">
          <v-icon name="star" class="h-4 inline-block"></v-icon> Tip: You can add more fields through plugins.
        </p>
        <v-form-select v-model="newWidget.type">
          <option value="">Select...</option>
          <option v-for="field in taskday().widgets()" :value="field.type">{{ field.type }}</option>
        </v-form-select>
      </div>
    </template>
    <template #actions="{ close }">
      <v-button @click="[close(), storeNewWidget()]" type="submit" class="button-primary"> Submit </v-button>
    </template>
  </v-modal>
  <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
    <v-widget v-for="widget in widgets" :widget="widget"></v-widget>
  </div>
</template>
