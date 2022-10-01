<script lang="ts" setup>
import vClickOutside from "@mahdikhashan/vue3-click-outside";
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";

let props = defineProps<{
  group?: any;
  value?: any;
  board: any;
}>();

const state = reactive({
  creating: false,
});

let newEntry = useForm({
  title: "",
  board_id: props.board.id,
  fields: {
    [props.group.id]: props.value,
  },
});

function storeEntry() {
  newEntry.post(route("entries.store"), {
    onSuccess: () => {
      newEntry.reset();
      state.creating = false;
    },
    preserveScroll: true,
  });
}

const vFocus = {
  mounted(el) {
    el.focus();
  },
};
</script>

<template>
  <div class="p-1">
    <div>
      <button @click="state.creating = true" v-show="!state.creating" class="button button-sm">  
        <v-icon name="plus" class="h-4 w-4" /> New
      </button>
      <form class="relative z-10" v-if="state.creating" @submit.prevent="storeEntry">
        <v-form-input v-focus v-model="newEntry.title" placeholder="Add an entry..."></v-form-input>
      </form>
      <div v-if="state.creating" class="fixed inset-0" @click="state.creating = false"></div>
    </div>
  </div>
</template>
