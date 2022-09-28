<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/reactivity";
import { PropType, reactive } from "vue";

let props = defineProps({
  board: Object,
  groups: Array as PropType<Field[]>,
  query: Object,
  breadcrumbs: Array,
});

let query = reactive({ ...props.query });

let group = computed(() => props.groups.find((g) => g.id == query.group_by));

let newView = useForm({
  type: "",
  board_id: props.board.id,
});
function storeNewView() {
  newView.post(route("views.store"));
}

let newField = useForm({
  title: '',
  type: "",
  board_id: props.board.id,
});
function storeNewField() {
  newField.post(route("fields.store"));
}
</script>

<template>
  <div>
    <div class="flex flex-col">
      <div class="flex flex-col gap-3">
        <v-breadcrumbs :pages="breadcrumbs" class="mb-4"/>
      </div>
      <div class="flex items-center justify-between gap-4">
        <v-title-editable :entry="board" routename="boards.update" />
        <div class="flex items-center gap-4">
          Group By: <VListbox v-if="group" v-model="query.group_by">
            <VListboxButton>
              {{ group.title }}
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
                    :class="[
                      selected ? 'font-semibold' : 'font-normal',
                      'block truncate',
                      active ? 'underline' : '',
                    ]"
                  >
                    {{ option.title }}
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
          <div v-else> no fields to group</div>
          <v-modal title="Add a view">
            <v-button class="button-secondary">
              <v-icon name="plus" class="h-6"></v-icon>
              <span>Add a view</span>
            </v-button>
            <template #content>
              <div class="w-full space-y-4">
                <p class="w-full text-gray-800 p-1 text-sm flex items-center gap-2 bg-gray-50 border rounded-sm">
                  <v-icon name="star" class="h-4 inline-block"></v-icon> Tip: You can add more views through plugins.
                </p>
                <v-form-select v-model="newView.type">
                  <option value="">Select...</option>
                  <option v-for="view in taskday().views()" :value="view.type">{{ view.type }}</option>
                </v-form-select>
              </div>
            </template>
            <template #actions>
              <v-button @click="storeNewView" type="submit" class="button-primary">
                Submit
              </v-button>
            </template>
          </v-modal>
          <v-modal title="Add a field">
            <v-button class="button-secondary">
              <v-icon name="plus" class="h-6"></v-icon>
              <span>Add a field</span>
            </v-button>
            <template #content>
              <div class="w-full space-y-4">
                <p class="w-full text-gray-800 p-1 text-sm flex items-center gap-2 bg-gray-50 border rounded-sm">
                  <v-icon name="star" class="h-4 inline-block"></v-icon> Tip: You can add more fields through plugins.
                </p>
                <v-form-input v-model="newField.title" label="Title" />
                <v-form-select v-model="newField.type">
                  <option value="">Select...</option>
                  <option v-for="field in taskday().fields()" :value="field.type">{{ field.type }}</option>
                </v-form-select>
              </div>
            </template>
            <template #actions>
              <v-button @click="storeNewField" type="submit" class="button-primary">
                Submit
              </v-button>
            </template>
          </v-modal>
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
          <v-tabs-panel v-for="view in board.views">
            <component
              :is="taskday().view(view.type).component"
              :view="view"
              :group="group"
              :board="board"
            />
          </v-tabs-panel>
        </v-tabs-panels>
      </v-tabs>
    </div>
    <div class="mt-4" v-else>
      Add a view to get started
    </div>
  </div>
</template>
