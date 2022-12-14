<script lang="ts" setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, watch, ref } from "vue";
import KanbanEntryCreate from "./KanbanEntryCreate.vue";
import vuedraggable from 'vuedraggable';

let props = defineProps<{ 
  view: any; 
  board: any 
  group?: any 
}>();

function entryForValue(value: number) {
  return props.board.entries.filter((entry) => {
    return entry.fields.find((field) => {
      return (parseInt(field.value) ? parseInt(field.value) : 0) == value && props.group?.id == field.id
    })
  });
}

function updateEntryColumn(column, entry) {
  Inertia.put(route('entries.fields.update', [entry, props.group.id]), {
    value: column.id
  }, {
    preserveScroll: true
  })
}

const columns = ref([]);

watch(() => props.group, () => {
  columns.value = props.group?.values.map((column) => {
    return {
      ...column,
      entries: entryForValue(column.id),
    }
  })
}, { immediate: true })
</script>
 
<template>
  <!-- Component Start -->
  <div class="">
    <div v-if="group" class="flex flex-grow mt-4 space-x-6 overflow-auto">
      <div v-for="column in columns" class="flex flex-col flex-shrink-0 w-72 h-screen">
        <div class="flex items-center justify-between flex-shrink-0 h-10 px-2">
          <div class="flex items-center">
            <span class="block text-sm font-semibold">{{ column.label }}</span>
            <span
              class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold bg-white rounded bg-opacity-30"
              :class="{
                'bg-gray-200 dark:bg-gray-400 text-gray-600 dark:text-gray-400 dark:bg-opacity-90': column.props.color == 'gray',
                'bg-red-200 dark:bg-red-400 text-red-600 dark:text-red-400 dark:bg-opacity-90': column.props.color == 'red',
                'bg-green-200 dark:bg-green-400 text-green-600 dark:text-green-400 dark:bg-opacity-90': column.props.color == 'green',
                'bg-yellow-200 dark:bg-yellow-400 text-yellow-600 dark:text-yellow-400 dark:bg-opacity-90': column.props.color == 'yellow',
              }" 
            >
              {{ column.entries.length }}
            </span>
          </div>
          <button
            class="flex items-center justify-center w-6 h-6 ml-auto rounded hover:bg-blue-500 hover:text-indigo-100"
          >
            <v-icon name="more-vertical" class="w-5 h-5" />
          </button>
        </div>
        <div class="flex flex-col pb-2 overflow-auto">
          <vuedraggable
            @change="
              ({ added }) => added && updateEntryColumn(column, added.element)
            "
            v-model="column.entries"
            group="entries"
            itemKey="id"
          >
          <template #item="{ element: entry }">
            <div
              class="hover:bg-gray-100 border relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100"
              draggable="true"
            >
              <div
                class="absolute top-0 right-0 flex items-center justify-center mt-3 mr-2 text-gray-500 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex"
              >
                <v-entry-menu :entry="entry">
                  <v-icon name="more-vertical" class="w-4 h-4 fill-current" />
                </v-entry-menu>
              </div>
              <Link :href="route('entries.show', entry)" class="hover:underline">
                <h4 class="text-sm font-medium" v-html="entry.title"></h4>
              </Link>
              <div v-for="field in board.fields.filter(f => f.type != group.type)">
                <component
                  :is="taskday().field(field.type).component"
                  :entry="entry"
                  :value="entry.fields?.find((f) => f.id == field.id)?.value ?? ''"
                  :field="field"
                  :readonly="true"
                ></component>
              </div>
              <div
                class="flex items-center w-full mt-3 text-xs font-medium text-gray-400"
              >
                <div class="flex items-center">
                  <v-icon
                    name="calendar"
                    class="w-4 h-4 text-gray-300 fill-current"
                  />
                  <span class="ml-1 leading-none">{{ entry.created_at }}</span>
                </div>
                <div class="flex items-center ml-4">
                  <v-icon
                    name="message-square"
                    class="w-4 h-4 text-gray-300 fill-current"
                  />
                  <span class="ml-1 leading-none">{{ entry.comments_count }}</span>
                </div>
                <img
                  class="w-6 h-6 ml-auto rounded-full"
                  :src="entry.user.profile_photo_url"
                />
              </div>
            </div>
          </template>
        </vuedraggable>
          <div>
            <KanbanEntryCreate :group="group" :value="column.id" :board="board" />
          </div>
        </div>
      </div> 
      <div class="flex-shrink-0 w-6"></div>
    </div>
    <div v-else>
      <span class="block mt-8 text-sm text-gray-600">
        You need at least one groupable field type
      </span>
    </div>
  </div>
  <!-- Component End -->
</template>
