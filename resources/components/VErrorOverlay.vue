<script lang="ts" setup>
import { ref, onMounted, watch, onUnmounted } from "vue";

const listener = ref(null);
const lastError = ref("");

onMounted(() => {
  console.log('Error overlay installed');
  listener.value = window.addEventListener("error", (err) => {
    lastError.value = err.message;
  });
});

onUnmounted(() => {
  if (listener && listener.value) {
    window.removeEventListener('error', listener.value);
  }
});
</script>

<template>
  <teleport to="body">
    <v-modal :open="lastError != ''"> 
      {{ lastError }}
    </v-modal>
  </teleport>
</template>
