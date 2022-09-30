<script lang="ts" setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ref, reactive, onMounted, watch } from 'vue';

defineProps<{ entry: Entry }>()
</script>

<template>
  <v-popper v-slot="{ setPopperRoot, setPopperElement }">
    <Menu>
      <MenuButton as="button" :ref="setPopperRoot" class="flex items-center justify-center py-1 text-gray-200 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex">
        <v-icon name="more-vertical" class="w-4 h-4 fill-current" />
      </MenuButton>
      <teleport to="body">
        <MenuItems>
          <div :ref="setPopperElement" class="bg-white text-gray-800 min-w-[12rem] rounded-md shadow-lg p-1 background-200 ring-1 ring-black ring-opacity-5 focus:outline-none max-h-[400px] overflow-auto">
            <MenuItem v-slot="{ active, selected }">
              <a :class='{ "bg-gray-100": active }' class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2" href="/account-settings">
                <v-icon name="share" class="h-4"></v-icon> Move
              </a>
            </MenuItem>

            <div class="my-1 px-1 h-px bg-gray-200 w-full" />
            <MenuItem disabled v-slot="{ active, selected }">
              <v-button-modal
                  title="Delete this entry?"
                  description="This operation is not reversable."
                >
                  <template #trigger>
                    <button
                      type="button"
                      method="delete"
                      :href="route('entries.destroy', entry)"
                      :class='{ "bg-gray-100": active }'
                      class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2"
                    >
                      <v-icon name="trash" class="h-4"></v-icon>
                      <span>Delete</span>
                    </button>
                  </template>
                  <template #actions="{ open }">
                    <v-button
                      type="button"
                      method="delete"
                      :href="route('entries.destroy', entry)"
                      class="button-danger inline-flex"
                    >
                      Delete
                    </v-button>
                  </template>
                </v-button-modal>
            </MenuItem>
          </div>
        </MenuItems>
      </teleport>
    </Menu>
  </v-popper>
</template>
