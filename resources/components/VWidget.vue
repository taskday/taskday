<script lang="ts" setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { Inertia } from "@inertiajs/inertia";

let props = defineProps<{ widget: any }>();

function destroy() {
  Inertia.delete(route('widgets.destroy', props.widget))
}
</script>

<template>
  <div class="relative group">
    <v-popper v-slot="{ setPopperRoot, setPopperElement }">
      <Menu>
        <MenuButton as="button" :ref="setPopperRoot" class="group-hover:block hidden absolute right-0 top-0 button-sm button">
          <v-icon name="more-vertical" class="h-4"></v-icon>
        </MenuButton>
        <teleport to="body">
          <MenuItems>
            <div
              :ref="setPopperElement"
              class="bg-white text-gray-800 min-w-[12rem] rounded-md shadow-lg p-1 background-200 ring-1 ring-black ring-opacity-5 focus:outline-none max-h-[400px] overflow-auto"
            >
              <MenuItem v-slot="{ active, selected }">
                <button
                  :class="{ 'text-red-600': active }"
                  class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2"
                  @click="destroy"
                >
                  Delete
                </button>
              </MenuItem>
            </div>
          </MenuItems>
        </teleport>
      </Menu>
    </v-popper>
    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
      <component
        :is="taskday().widget(widget.type).component"
        :widget="widget"
      ></component>
    </div>
  </div>
</template>
