<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
  category: Object,
});

const newBoard = useForm({
  title: "",
  category_id: props.category.id,
});

function submit() {
  newBoard.post(route("boards.store"), {
    onFinish: () => newBoard.reset(),
  });
}
</script>

<template>
  <div class="space-y-4">
    <v-title-editable :entry="category" routename="categories.update" />
    <form @submit.prevent="submit">
      <v-form-input
        v-model="newBoard.title"
        :errors="newBoard.errors.title"
        placeholder="Add a board..."
      />
    </form>
    <div>
      <div v-for="board in category.boards">
        <Link :href="route('boards.show', board)">
          {{ board.title }}
        </Link>
      </div>
    </div>
  </div>
</template>
