<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, reactive, onMounted, watch } from "vue";

let props = defineProps<{ board: any }>();

let newView = useForm({
  type: "",
  board_id: props.board.id,
});

function storeNewView() {
  newView.post(route("views.store"), {
    onSuccess: () => newView.reset(),
  });
}
</script>

<template>
  <v-modal title="Add a view">
    <v-button class="button-secondary button-sm">
      <v-icon name="plus" class="h-4"></v-icon>
      <span>View</span>
    </v-button>
    <template #content>
      <div class="w-full space-y-4">
        <p class="w-full text-gray-800 p-1 text-sm flex items-center gap-2 bg-gray-50 border rounded-sm">
          <v-icon name="star" class="h-4 inline-block"></v-icon> Tip: You can add more views through plugins.
        </p>
        <v-form-select v-model="newView.type">
          <option value="">Select...</option>
          <option v-for="view in taskday().views()" :value="view.type">{{ view.type }}</option>
        </v-form-select>
      </div>
    </template>
    <template #actions="{ close }">
      <v-button @click="[close(), storeNewView()]" type="submit" class="button-primary"> Submit </v-button>
    </template>
  </v-modal>
</template>
