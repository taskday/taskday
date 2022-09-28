<script lang="ts" setup>
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({ title: "" });

function submit() {
  form.post(route("entries.store"), {
    onSuccess: () => (form.title = ""),
  });
}
</script>

<template>
  <div>
    <form @submit.prevent="submit">
      <v-form-input
        type="text"
        placeholder="Something..."
        v-model="form.title"
      />
    </form>
  </div>
</template>
