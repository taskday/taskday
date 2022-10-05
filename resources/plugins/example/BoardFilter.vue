<script lang="ts" setup>
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  filter: Object,
});

const boards = ref([]);

const selectedBoard = ref(props.filter.value);

onMounted(() => {
  axios.get(route('api.boards.index')).then((res) => {
    boards.value = res.data;
  })
})

watch(() => selectedBoard.value, (value) => {
  Inertia.put(route('filters.update', props.filter), {
    operator: props.filter.operator,
    value,
  })
})
</script>

<template>
  <div>
    <v-listbox v-model="selectedBoard">
      <v-listbox-button>
        {{ boards.find(b => b.id == selectedBoard)?.title ?? 'Select a board...' }}
      </v-listbox-button>
      <v-listbox-options>
        <v-listbox-option :value="board.id" v-for="board in boards">
          {{ board.title }}
        </v-listbox-option>
      </v-listbox-options>
    </v-listbox>
  </div>
</template>
