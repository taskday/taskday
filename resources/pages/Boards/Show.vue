<script lang="ts" setup>
import { computed } from "@vue/reactivity";
import { PropType, reactive } from "vue";
import CreateField from "./Partials/CreateField.vue";
import CreateView from "./Partials/CreateView.vue";

let props = defineProps({
  board: Object,
  groups: Array as PropType<Field[]>,
  query: Object,
  breadcrumbs: Array,
});

let query = reactive({ ...props.query });
let group = computed(() => props.groups.find((g) => g.id == query.group_by));
</script>

<template>
  <div>
    <div class="flex flex-col">
      <div class="flex flex-col gap-3">
        <v-breadcrumbs :pages="breadcrumbs" class="mb-4" />
      </div>
      <div class="flex items-center justify-between gap-4">
        <v-title-editable :entry="board" routename="boards.update" />
        <div class="flex items-center gap-4">
          
          <VListbox v-if="group" v-model="query.group_by">
            <VListboxButton>
              Group By: {{ group.title }}
            </VListboxButton>
            <VListboxOptions>
              <VListboxOption
                as="template"
                v-for="option in groups"
                :key="option.id"
                :value="option.id"
                v-slot="{ active, selected }"
              >
                <div class="flex items-center gap-6 justify-between">
                  <span
                    :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate', active ? 'underline' : '']"
                  >
                    {{ option.title }}
                  </span>
                  <span
                    v-if="selected"
                    :class="[active ? 'text-indigo-600' : 'text-indigo-600', 'inset-y-0 right-0 flex items-center']"
                  >
                    <v-icon name="check" class="h-6"></v-icon>
                  </span>
                </div>
              </VListboxOption>
            </VListboxOptions>
          </VListbox>
          <div v-else>no fields to group</div>
          <CreateView  :board="board" />
          <CreateField :board="board"  />
          <v-button class="button-secondary button-sm" :href="route('boards.edit', board)">
            <v-icon name="settings" class="h-4"></v-icon>
          </v-button>
        </div>
      </div>
    </div>
    <div class="mt-4" v-if="board.views.length > 0">
      <v-tabs>
        <v-tabs-list>
          <v-tabs-item v-for="view in board.views">
            {{ view.title }}
          </v-tabs-item>
        </v-tabs-list>
        <v-tabs-panels>
          <v-tabs-panel v-for="view in board.views" :key="view.id">
            <component :is="taskday().view(view.type).component" :view="view" :group="group" :board="board" />
          </v-tabs-panel>
        </v-tabs-panels>
      </v-tabs>
    </div>
    <div class="mt-4" v-else>Add a view to get started</div>
  </div>
</template>
