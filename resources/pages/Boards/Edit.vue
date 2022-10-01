<script lang="ts" setup>
import { ref, reactive, onMounted, watch } from "vue";
import UpdateMembers from "./Partials/UpdateMembers.vue";

defineProps<{ title: string, board: any }>();
</script>

<template>
  <div class="space-y-4">
    <v-title>{{ title }}</v-title>

    <UpdateMembers :board="board" />

    <v-form-section>
      <template #title>Delete Project</template>
      <template #description>This will delete this project.</template>
      <template #content>
        <v-button-modal
          title="Are you sure?"
          description="You cannot undo this action"
        >
          <v-button class="button-danger">Delete</v-button>
          <template #actions>
            <Link class="button button-danger" method="delete" :href="route('boards.destroy', board)">Delete</Link>
          </template>
        </v-button-modal>
      </template>
    </v-form-section>
  </div>
</template>
