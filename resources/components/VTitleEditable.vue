<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import VFormEditor from "@/components/VFormEditor.vue";

let props = defineProps<{ entry: { title: string }, routename: string }>();

let form = useForm({ title: props.entry.title });

function submit() {
  form.put(route(props.routename, props.entry));
}
</script>

<template>
  <div>
    <VFormEditor
      :toolbar="false"
      v-model="form.title"
      @blur="submit"
      class="text-2xl font-bold text-gray-900"
    >
    </VFormEditor>
  </div>
</template>
