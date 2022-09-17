<script lang="ts" setup>
defineProps<{ entry: Entry }>();
</script>

<template>
  <section aria-labelledby="activity-title" class="mt-8 xl:mt-10">
    <div>
      <div class="divide-y divide-gray-200">
        <div class="pb-4">
          <h2 id="activity-title" class="text-lg font-medium text-gray-900">
            Activity
          </h2>
        </div>
        <div class="pt-6">
          <div v-for="audit in entry.activities" class="relative pb-8">
            <component
              :is="`activities-${audit.event}`"
              :activity="audit"
            />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
