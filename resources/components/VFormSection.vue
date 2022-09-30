<template>
  <VCard>
    <div class="mb-6">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg leading-6 font-medium">
          <slot name="title"></slot>
        </h3>
        <p v-if="$slots.description" class="opacity-80 mt-1">
          <slot name="description"></slot>
        </p>
      </div>
    </div>
    <div class="space-y-4">
      <slot name="content"></slot>
    </div>
  </VCard>
</template>
