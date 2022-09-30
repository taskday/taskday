<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import VFormEditor from "@/components/VFormEditor.vue";

let props = defineProps<{ entry: Entry }>();

let form = useForm({ title: props.entry.title });

function submit() {
  form.put(route("entries.update", props.entry));
}
</script>

<template>
  <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
    <div>
      <VFormEditor
        :toolbar="false"
        v-model="form.title"
        @blur="submit"
        class="text-2xl font-bold text-gray-900"
      >
      </VFormEditor>
      <p class="mt-2 text-sm text-gray-500">
        created by
        {{ " " }}
        <span class="font-medium text-gray-900">
          {{ entry.user.name }}
        </span>
      </p>
    </div>
    <div class="mt-4 flex space-x-3 md:mt-0">
      <!-- TODO: Buttons -->
    </div>
  </div>
</template>
