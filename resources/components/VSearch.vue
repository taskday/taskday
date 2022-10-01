<script lang="ts" setup>
import { ref, watch } from "vue";
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

const items = ref([]);
const open = ref(false);
const query = ref("");

useShortcut('cmd+k', () => {
  open.value = true
})

function onSelect(person) {
  Inertia.visit(route('entries.show', person), {
    onSuccess: () => open.value = false
  });
}

watch(
  () => query.value,
  () => {
    if (query.value.length > 1) {
      axios.get(route("api.search", { search: query.value }))
        .then((res) => {
          items.value = res.data;
        })
        .catch((err) => {
          items.value = [];
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

                  <ComboboxOptions
                    v-if="items.length > 0"
                    static
                    class="-mb-2 max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800"
                  >
                    <ComboboxOption
                      v-for="person in items"
                      :key="person.id"
                      :value="person"
                      as="template"
                      v-slot="{ active }"
                    >
                      <li
                        :class="[
                          'cursor-default select-none rounded-md px-4 py-2',
                          active && 'bg-blue-600 text-white',
                        ]"
                      >
                        {{ person.title }}
                      </li>
                    </ComboboxOption>
                  </ComboboxOptions>

                  <div v-if="query !== '' && items.length === 0" class="py-14 px-4 text-center sm:px-14">
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
