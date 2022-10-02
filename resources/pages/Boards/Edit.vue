<script lang="ts" setup>
import UpdateMembers from "./Partials/UpdateMembers.vue";
import DeleteBoard from "./Partials/DeleteBoard.vue";

defineProps<{ title: string, board: any, users: User[] }>();
</script>

<template>
  <div class="space-y-4">
    <v-title>{{ title }}</v-title>

    <UpdateMembers :board="board" :users="users" />

    <DeleteBoard :board="board" />
  </div>
</template>
