<script lang="ts" setup>
defineProps<{ board: any }>();
</script>

<template>
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
</template>
