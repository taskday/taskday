<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { computed, watch, PropType } from "vue";

let props = defineProps({
  value: { type: Object as PropType<any> },
  field: { type: Object as PropType<Field> },
  entry: { type: Object as PropType<any> },
  readonly: { type: Boolean, default: false },
});

const form = useForm({
  value: props.value,
});

watch(
  () => form.value,
  () => {
    form.put(route("entries.fields.update", [props.entry, props.field]), {
      preserveScroll: true,
    });
  }
);

const groupValue = computed(() => {
  return (
    props.field.values.find((v) => v.id === form.value) ?? {
      id: "",
      label: "-",
      props: { color: "gray" },
    }
  );
});
</script>

<template>
  <span>
    <VListbox v-if="!props.readonly" v-model="form.value">
      <VListboxButton>
        <span class="flex items-center">
          <span
            class="flex-shrink-0 inline-block h-2 w-2 rounded-full"
            :class="{
              'bg-gray-400 dark:bg-gray-400 dark:bg-opacity-90': groupValue.props.color === 'gray',
              'bg-red-400 dark:bg-red-400 dark:bg-opacity-90': groupValue.props.color === 'red',
              'bg-green-400 dark:bg-green-400 dark:bg-opacity-90': groupValue.props.color === 'green',
              'bg-yellow-400 dark:bg-yellow-400 dark:bg-opacity-90': groupValue.props.color === 'yellow',
            }"
          />
          <span class="ml-3 block truncate">{{ groupValue.label }}</span>
        </span>
      </VListboxButton>

      <VListboxOptions>
        <VListboxOption
          as="template"
          v-for="option in field.values"
          :key="option.id"
          :value="option.id"
          v-slot="{ active, selected }"
        >
          <div class="flex items-center gap-2">
            <span
              class="flex-shrink-0 inline-block h-2 w-2 rounded-full"
              :class="{
                'bg-gray-400 dark:bg-gray-400 dark:bg-opacity-90': option.props.color === 'gray',
                'bg-red-400 dark:bg-red-400 dark:bg-opacity-90': option.props.color === 'red',
                'bg-green-400 dark:bg-green-400 dark:bg-opacity-90': option.props.color === 'green',
                'bg-yellow-400 dark:bg-yellow-400 dark:bg-opacity-90': option.props.color === 'yellow',
              }"
              aria-hidden="true"
            />
            <span
              :class="[
                selected ? 'font-semibold' : 'font-normal', 
                'ml-3 block truncate',
                active ? 'underline' : '',
              ]"
            >
              {{ option.label }}
            </span>
            <span
              v-if="selected"
              :class="[
                active ? 'text-indigo-600' : 'text-indigo-600',
                'inset-y-0 right-0 flex items-center',
              ]"
            >
              <v-icon name="check" class="h-6"></v-icon>
            </span>
          </div>
        </VListboxOption>
      </VListboxOptions>
    </VListbox>
    <span v-else>
      <span
        :class="{
          'bg-gray-100 dark:bg-gray-400 text-gray-600 dark:text-gray-400 dark:bg-opacity-90':
            groupValue.props.color === 'gray',
          'bg-red-100 dark:bg-red-400 text-red-600 dark:text-red-400 dark:bg-opacity-90':
            groupValue.props.color === 'red',
          'bg-green-100 dark:bg-green-400 text-green-600 dark:text-green-400 dark:bg-opacity-90':
            groupValue.props.color === 'green',
          'bg-yellow-100 dark:bg-yellow-400 text-yellow-600 dark:text-yellow-400 dark:bg-opacity-90':
            groupValue.props.color === 'yellow',
        }"
      >
        {{ groupValue.label }}
      </span>
    </span>
  </span>
</template>
