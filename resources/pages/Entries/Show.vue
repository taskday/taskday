<script setup lang="ts">
import Details from "./Partials/Details.vue";
import Fields from "./Partials/Fields.vue";
import Activities from "./Partials/Activities.vue";
import EditableTitle from "./Partials/EditableTitle.vue";
import Comments from "./Partials/Comments.vue";

defineProps<{ entry: Entry }>();
</script>

<template>
  <div>
    <main class="flex-1">
      <div class="py-6 xl:py-8 px-4 sm:px-6">
        <div class="mx-auto xl:grid xl:grid-cols-3">
          <div class="xl:col-span-2 xl:border-r xl:border-gray-200 xl:pr-8">
            <div>
              <EditableTitle :entry="entry" />
              <aside class="mt-8 xl:hidden">
                <Details :entry="entry" />
                <Fields :entry="entry" />
              </aside>
              <div class="py-3 xl:pt-6 xl:pb-0">
                <h2 class="sr-only">Description</h2>
                <div class="prose max-w-none">
                  <!-- content -->
                </div>
              </div>
            </div>
            <Activities :entry="entry" />
            <Comments :entry="entry" />
          </div>
          <aside class="hidden xl:block xl:pl-8">
            <div class="mb-6">
              <v-modal
                title="Delete this entry?"
                description="This operation is not reversable."
              >
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
              </v-modal>
            </div>
            <Details :entry="entry" />
            <Fields :entry="entry" />
          </aside>
        </div>
      </div>
    </main>
  </div>
</template>
