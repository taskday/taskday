<script lang="ts" setup>
import { ref, reactive, onMounted, watch } from 'vue';
import Activities from '@/pages/Entries/Partials/Activities.vue';

let props = defineProps<{ 
  view: any; 
  board: any 
  group?: any 
}>();
</script>

<template>
  <div>
    <div v-for="entry in board.entries">
      <Activities :entry="entry" />
    </div>
  </div>
</template>
