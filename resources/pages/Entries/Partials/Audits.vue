<script lang="ts" setup>
defineProps<{ entry: Entry }>()
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
          <div v-for="audit in entry.audits">
            <div class="relative flex items-start space-x-3">
              <div>
                <div class="relative px-1">
                  <div
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white"
                  >
                    <v-icon
                      name="user"
                      class="h-5 w-5 text-gray-500"
                      aria-hidden="true"
                    />
                  </div>
                </div>
              </div>
              <div class="min-w-0 flex-1 py-1.5">
                <div class="text-sm text-gray-600">
                  <span class="text-gray-900 font-medium">
                    {{ audit.user.name }}
                  </span>
                  <template v-for="(value, key) in audit.new_values">
                    <span>
                      {{ " " }}
                      <span class="">{{ audit.event }} </span>
                      {{ " " }}
                      <span class="text-gray-900 font-medium">{{ key }}</span>
                      {{ " " }}
                      <span class=""> from </span>
                      {{ " " }}
                      <span
                        class="text-gray-900 font-medium inline-block"
                        v-html="audit.old_values[key]"
                      ></span>
                      {{ " " }}
                      <span class="">to</span>
                      {{ " " }}
                      <span
                        class="text-gray-900 font-medium inline-block"
                        v-html="value"
                      ></span>
                      {{ " " }}
                      <span class="">
                        {{ moment(audit.created_at).fromNow() }}
                      </span>
                    </span>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
