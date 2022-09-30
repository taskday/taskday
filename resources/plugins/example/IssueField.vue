<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { PropType } from "vue";

let props = defineProps({
  value: { type: String },
  field: { type: Object as PropType<Field> },
  entry: { type: Object as PropType<any> },
  readonly: { type: Boolean, default: true },
});

const form = useForm({
  name: 'generate'
})

const update = () => {
  form.post(route('entries.fields.actions', [props.entry, props.field]))
}
</script>

<template>
  <span v-if="value" class="font-mono text-sm text-gray-600">
    #{{ value }}
  </span>
  <span v-else class="text-sm text-gray-600">
    <v-button class="button-secondary button-small" @click="update">
      Generate
    </v-button>
  </span>
</template>
