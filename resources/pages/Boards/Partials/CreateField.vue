<script lang="ts" setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps<{ board: any }>();

let newField = useForm({
  title: "",
  type: "",
  board_id: props.board.id,
  options: {},
});

function storeNewField() {
  newField.post(route("fields.store"), {
    onSuccess: () => {
      newField.reset();
      Inertia.visit(route("boards.show", props.board));
    },
  });
}
</script>

<template>
  <v-modal title="Add a field">
    <v-button class="button-secondary button-sm">
      <v-icon name="plus" class="h-4"></v-icon>
      <span>Field</span>
    </v-button>
    <template #content>
      <div class="w-full space-y-4">
        <p class="w-full text-gray-800 p-1 text-sm flex items-center gap-2 bg-gray-50 border rounded-sm">
          <v-icon name="star" class="h-4 inline-block"></v-icon> Tip: You can add more fields through plugins.
        </p>
        <v-form-input v-model="newField.title" label="Title" />
        <v-form-select v-model="newField.type">
          <option value="">Select...</option>
          <option v-for="field in taskday().fields()" :value="field.type">{{ field.type }}</option>
        </v-form-select>
        <component
          :is="taskday().field(newField.type)?.options"
          :form="newField"
          @change="(options) => (newField.options = options)"
        />
      </div>
    </template>
    <template #actions="{ close }">
      <v-button @click="[close(), storeNewField()]" type="submit" class="button-primary"> Submit </v-button>
    </template>
  </v-modal>
</template>
