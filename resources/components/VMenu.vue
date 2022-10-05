<script lang="ts">
export default {
  inheritAttrs: false,
};
</script>

<script lang="ts" setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
</script>

<template>
  <v-popper v-slot="{ setPopperRoot, setPopperElement }">
    <Menu>
      <MenuButton as="button" :ref="setPopperRoot" class="button" v-bind="$attrs"> 
      <slot></slot>
      </MenuButton>
      <teleport to="body">
        <MenuItems>
          <div
            :ref="setPopperElement"
            class="bg-white text-gray-800 min-w-[12rem] rounded-md shadow-lg p-1 background-200 ring-1 ring-black ring-opacity-5 focus:outline-none max-h-[400px] overflow-auto"
          >
            <slot name="content"></slot>
          </div>
        </MenuItems>
      </teleport>
    </Menu>
  </v-popper>
</template>
