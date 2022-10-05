<script lang="ts" setup>
import { reactive, ref, watch } from "vue";
import { useShortcut } from '@/composables/useShortcut'; 
import {
  Combobox,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
  Dialog,
  DialogPanel,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

import { Inertia } from "@inertiajs/inertia";
import axios from "axios";

const state = reactive({
  entries: [],
  boards: [],
});
const open = ref(false);
const query = ref("");

useShortcut('cmd+k', () => {
  open.value = true
})

function onSelect(person) {
  if (! person.category) {
    Inertia.visit(route('entries.show', person), {
      onSuccess: () => open.value = false
    });
  } else {
    Inertia.visit(route('boards.show', person), {
      onSuccess: () => open.value = false
    });
  }
}

watch(
  () => query.value,
  () => {
    if (query.value.length > 1) {
      axios.get(route("api.entries.index", { search: query.value }))
        .then((res) => {
          state.entries = res.data.data;
        })
        .catch((err) => {
          state.entries = [];
          console.error(err)
        });
      axios.get(route("api.boards.index", { search: query.value }))
        .then((res) => {
          state.boards = res.data.data;
        })
        .catch((err) => {
          state.boards = [];
          console.error(err)
        });
    }
  }
);
</script>

<template>
  <div class="flex items-center">
    <button type="button" @click="open = true" class="relative w-full rounded-full text-gray-400 focus-within:text-gray-600 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
      <div class="">
        <v-icon name="search" class="h-6 w-6" aria-hidden="true" />
      </div>
    </button>
    <teleport to="body">
      <TransitionRoot :show="open" as="template" @after-leave="query = ''" appear>
        <Dialog as="div" class="relative z-10" @close="open = false">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in duration-200"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity" />
          </TransitionChild>

          <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20">
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="ease-in duration-200"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="mx-auto max-w-xl transform rounded-xl bg-white p-2 shadow-2xl ring-1 ring-black ring-opacity-5 transition-all"
              >
                <Combobox @update:modelValue="onSelect">
                  <ComboboxInput
                    class="w-full rounded-md border-0 bg-gray-100 px-4 py-2.5 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                    placeholder="Search..."
                    @change="query = $event.target.value"
                  />

                  <ComboboxOptions static class="max-h-80 scroll-pt-11 scroll-pb-2 space-y-2 overflow-y-auto pb-2">
                    <li v-if="state.boards.length > 0">
                      <h2 class="bg-gray-100 py-2.5 px-4 text-xs font-semibold text-gray-900">
                        Boards
                      </h2>
                      <ul class="mt-2 text-sm text-gray-800">
                        <ComboboxOption v-for="item in state.boards" :key="item.id" :value="item" as="template" v-slot="{ active }">
                          <li :class="['whitespace-nowrap truncate cursor-default select-none px-4 py-2 flex items-center justify-between', active && 'bg-indigo-600 text-white']">
                            <span>{{ item.title }} </span>
                            <span :class="['opacity-80']">{{ item.category?.title }}</span>
                          </li>
                        </ComboboxOption>
                      </ul>
                    </li>
                    <li v-if="state.entries.length > 0">
                      <h2 class="bg-gray-100 py-2.5 px-4 text-xs font-semibold text-gray-900">
                        Entries
                      </h2>
                      <ul class="mt-2 text-sm text-gray-800">
                        <ComboboxOption v-for="item in state.entries" :key="item.id" :value="item" as="template" v-slot="{ active }">
                          <li :class="['whitespace-nowrap truncate cursor-default select-none px-4 py-2', active && 'bg-indigo-600 text-white']">
                            <div class="flex items-center justify-between mb-2">
                              <span>{{ item.title }} </span>
                              <span :class="['opacity-80']">{{ item.board?.category?.title }} / {{ item.board?.title }}</span>
                            </div>
                            <v-entry-fields v-if="active" :entry="item" :readonly="true" class="w-full flex-1 flex items-center flex-wrap gap-3"/>
                          </li>
                        </ComboboxOption>
                      </ul>
                    </li>
                  </ComboboxOptions>

                  <div v-if="query !== '' && state.entries.length === 0 && state.boards.length === 0" class="py-14 px-4 text-center sm:px-14">
                    <v-icon name="user" class="mx-auto h-6 w-6 text-gray-400" aria-hidden="true" />
                    <p class="mt-4 text-sm text-gray-900">No people found using that search term.</p>
                  </div>
                </Combobox>
              </DialogPanel>
            </TransitionChild>
          </div>
        </Dialog>
      </TransitionRoot>
    </teleport>
  </div>
</template>
