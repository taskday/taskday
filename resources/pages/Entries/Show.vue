<script setup lang="ts">
import { onMounted } from "vue";
import { useEntryStore } from "./useEntryStore";
import Details from "./Partials/Details.vue";
import Fields from "./Partials/Fields.vue";
import Activities from "./Partials/Activities.vue";
import EditableTitle from "./Partials/EditableTitle.vue";
import Comments from "./Partials/Comments.vue";
import Actions from "./Partials/Actions.vue";

const props = defineProps<{ entry: Entry; breadcrumbs: object[] }>();

const entryStore = useEntryStore();

onMounted(() => {
  entryStore.update(props.entry.title, props.entry.content);
});
</script>

<template>
  <div>
    <main class="flex-1">
      <div class="">
        <div class="mx-auto xl:grid xl:grid-cols-3">
          <div class="xl:col-span-2 xl:border-r xl:border-gray-200 xl:pr-8">
            <div>
              <EditableTitle :entry="entry" />
              <aside class="mt-8 xl:hidden">
                <Actions :entry="entry" />
                <Details :entry="entry" />
                <Fields :entry="entry" />
              </aside>
              <div class="py-3 xl:pt-6 xl:pb-0">
                <h2 class="sr-only">Description</h2>
                <VFormEditor v-model="entryStore.content"></VFormEditor>
              </div>
            </div>
            <Activities :entry="entry" />
            <Comments :entry="entry" />
          </div>
          <aside class="hidden xl:block xl:pl-8">
            <Actions :entry="entry" />
            <Details :entry="entry" />
            <Fields :entry="entry" />
          </aside>
        </div>
      </div>
    </main>
  </div>
</template>
