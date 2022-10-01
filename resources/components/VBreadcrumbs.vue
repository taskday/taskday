<script setup lang="ts">
defineProps<{
  pages: { name: string, href: string, current: boolean }[]
}>()
</script>

<template>
  <nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <!-- <li v-if="">
        <div>
          <Link href="/" class="text-gray-400 hover:text-gray-500">
            <v-icon name="home" class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
            <span class="sr-only">Home</span>
          </Link>
        </div>
      </li> -->
      <li v-for="page in pages" :key="page.name">
        <div class="flex items-center">
          <v-icon
            name="chevron-right"
            class="h-4 w-4 flex-shrink-0 text-gray-400"
            aria-hidden="true"
          />
          <Link
            :href="page.href"
            class="ml-1 text-xs font-medium text-gray-500 hover:text-gray-700"
            :aria-current="page.current ? 'page' : undefined"
            v-html="page.name"
          >
          </Link>
        </div>
      </li>
    </ol>
  </nav>
</template>
