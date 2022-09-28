<script lang="ts" setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";
import KanbanEntryCreate from "./KanbanEntryCreate.vue";
import vuedraggable from 'vuedraggable';

let props = defineProps<{ 
  view: any; 
  board: any 
  group?: any 
}>();

function entryForValue(value: number) {
  return props.board.entries.filter((entry) => {
    return entry.fields.find((field) => (parseInt(field.value) ? parseInt(field.value) : 0) == value)
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

onMounted(() => {
  columns.value = props.group?.values.map((column) => {
    return {
      ...column,
      entries: entryForValue(column.id),
    }
  })
})
</script>
 
<template>
  <!-- Component Start -->
  <div class="">
    <div v-if="group" class="flex flex-grow mt-4 space-x-6 overflow-auto">
      <div v-for="column in columns" class="flex flex-col flex-shrink-0 w-72">
        <div class="flex items-center justify-between flex-shrink-0 h-10 px-2">
          <div class="flex items-center">
            <span class="block text-sm font-semibold">{{ column.label }}</span>
            <span
              class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-blue-500 bg-white rounded bg-opacity-30"
              :class="{
                'bg-gray-100 dark:bg-gray-400 text-gray-600 dark:text-gray-400 dark:bg-opacity-90': column.props.color == 'gray',
                'bg-red-100 dark:bg-red-400 text-red-600 dark:text-red-400 dark:bg-opacity-90': column.props.color == 'red',
                'bg-green-100 dark:bg-green-400 text-green-600 dark:text-green-400 dark:bg-opacity-90': column.props.color == 'green',
                'bg-yellow-100 dark:bg-yellow-400 text-yellow-600 dark:text-yellow-400 dark:bg-opacity-90': column.props.color == 'yellow',
              }" 
            >
              {{ column.entries.length }}
            </span>
          </div>
          <button
            class="flex items-center justify-center w-6 h-6 ml-auto text-blue-500 rounded hover:bg-blue-500 hover:text-indigo-100"
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
              <button
                class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 mt-3 mr-2 text-gray-500 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex"
              >
                <v-icon name="more-vertical" class="w-4 h-4 fill-current" />
              </button>
              <Link :href="route('entries.show', entry)" class="hover:underline">
                <h4 class="text-sm font-medium" v-html="entry.title"></h4>
              </Link>
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
                <div class="relative flex items-center ml-4">
                  <v-icon
                    name="message-square"
                    class="relative w-4 h-4 text-gray-300 fill-current"
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
        <v-modal>

            <v-button type="button" class="button-primary">
              <v-icon name="plus" class="h-4 w-4 text-white stroke-current" />
              <span>Add a field</span>
            </v-button>

          <template #content>
            <!-- TODO: add / create field form to board -->
          </template>
        </v-modal>
      </span>
    </div>
  </div>
  <!-- Component End -->
</template>
