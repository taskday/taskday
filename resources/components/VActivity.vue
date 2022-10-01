<script lang="ts" setup>
defineProps<{ icon: String }>()
</script>

<template>
  <div class="relative flex flex-col sm:flex-row items-start space-x-3">
    <div class="hidden sm:block">
      <div class="relative px-1">
        <div
          class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white"
        >
          <v-icon
            :name="icon"
            class="h-5 w-5 text-gray-500"
            aria-hidden="true"
          />
        </div>
      </div>
    </div>
    <div class="min-w-0 flex-1 pb-1.5">
      <div class="text-sm text-gray-500">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
