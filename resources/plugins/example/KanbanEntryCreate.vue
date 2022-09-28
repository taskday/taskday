<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps<{ 
  group?: any; 
  value?: any; 
  board: any;
}>();

let newEntry = useForm({
  title: "",
  board_id: props.board.id,
  fields: {
    [props.group.id]: props.value
  }
});

function storeEntry() {
  newEntry.post(route("entries.store"), {
    onSuccess: () => newEntry.reset(),
    preserveScroll: true,
  });
}
</script>

<template>
  <div>
    <form @submit.prevent="storeEntry">
      <v-form-input v-model="newEntry.title" placeholder="Add an entry..."></v-form-input>
    </form>
  </div>
</template>
