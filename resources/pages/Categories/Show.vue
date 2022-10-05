<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

let props = defineProps({
  category: Object,
});

const newBoard = useForm({
  title: "",
  category_id: props.category.id,
});

function submit() {
  newBoard.post(route("boards.store"), {
    onSuccess: () => {
      newBoard.reset();
      state.adding = false;
    },
  });
}

const state = reactive({
  adding: false,
});
</script>

<template>
  <div class="space-y-4">
    <v-title-editable :entry="category" routename="categories.update" />
    <div>
      <div class="sm:grid sm:grid-cols-2 sm:gap-2">
        <div
          v-for="board in category.boards"
          :key="board.title"
          class="hover:bg-gray-100 relative group rounded-lg shadow bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500"
        >
          <div>
            <span class="rounded-lg inline-flex p-3 ring-4 ring-white bg-white">
              <v-icon name="folder" class="h-6 w-6" />
            </span>
          </div>
          <div class="mt-8">
            <h3 class="text-lg font-medium">
              <Link :href="route('boards.show', board)" class="focus:outline-none">
                <!-- Extend touch target to entire panel -->
                <span class="absolute inset-0" aria-hidden="true" />
                {{ board.title }}
              </Link>
            </h3>
            <p class="mt-2 text-sm text-gray-500">Updated at {{ board.updated_at }}</p>
          </div>
          <span
            class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400"
            aria-hidden="true"
          >
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z"
              />
            </svg>
          </span>
        </div>
        <div>
          <div v-if="state.adding" class="absolute inset-0" @click="state.adding = false"></div>
          <div class="relative h-full group rounded-lg shadow bg-white p-6">
            <div>
              <span class="rounded-lg inline-flex p-3 ring-4 ring-white bg-white">
                <v-icon name="folder" class="h-6 w-6" />
              </span>
            </div>
            <div class="mt-8">
              <div class="text-lg font-medium" v-if="!state.adding">
                <v-button class="button-sm button-secondary" @click="state.adding = true">
                  <v-icon name="plus" class="h-4 w-4"></v-icon> Add board
                </v-button>
              </div>
              <div v-else-if="state.adding">
                <div class="max-w-xs">
                  <form @submit.prevent="submit">
                    <v-form-input v-model="newBoard.title" :errors="newBoard.errors.title" placeholder="Add a board..." />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
