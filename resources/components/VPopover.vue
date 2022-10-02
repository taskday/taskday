<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover class="relative" v-slot="{ open }">
    <PopoverButton
      :class="[
        open ? 'text-gray-900' : 'text-gray-500',
        `group inline-flex items-center rounded-full bg-white text-base font-medium 
        hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2`,
      ]"
    >
      <slot></slot>
    </PopoverButton>
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-y-1"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-1"
    >
      <PopoverPanel
        class="absolute right-0 z-10 mt-3 w-screen max-w-xs origin-top-right rounded-md ring-1 ring-black ring-opacity-5 focus:outline-none"
        v-slot="{ close }"
      >
        <div
          class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
        >
          <div class="relative bg-white px-5 py-6 sm:gap-8">
            <slot name="content" :close="close"></slot>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script setup lang="ts">
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
</script>
