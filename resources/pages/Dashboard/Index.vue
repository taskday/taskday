<script lang="ts" setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps<{ widgets: any[] }>();


function storeNewWidget(widget) {
  const newWidget = useForm({
    type: widget.type,
  });

  newWidget.post(route("widgets.store"), {
    onSuccess: () => newWidget.reset(),
    preserveScroll: true,
  });
}
</script>

<template>
  <v-popper v-slot="{ setPopperRoot, setPopperElement }">
    <Menu>
      <MenuButton as="button" :ref="setPopperRoot" class="button button-secondary">
        <v-icon name="plus" class="h-4"></v-icon>
        <span>Widget</span>
      </MenuButton>
      <teleport to="body">
        <MenuItems>
          <div
            :ref="setPopperElement"
            class="bg-white text-gray-800 min-w-[12rem] rounded-md shadow-lg p-1 background-200 ring-1 ring-black ring-opacity-5 focus:outline-none max-h-[400px] overflow-auto"
          >
            <MenuItem v-for="widget in taskday().widgets()" :value="widget.type" v-slot="{ active, selected }">
              <button
                :class="{ 'bg-gray-100': active }"
                class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2"
                @click="storeNewWidget(widget)"
              >
                {{ widget.type }}
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </teleport>
    </Menu>
  </v-popper>
  <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-8">
    <v-widget v-for="widget in widgets" :widget="widget"></v-widget>
  </div>
</template>
