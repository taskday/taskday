<template>
  <VCardAuth>
    <div class="mb-4 text-sm text-gray-600">
      This is a secure area of the application. Please confirm your password
      before continuing.
    </div>

    <VFormErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <VFormInput
          label="Password"
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
          autofocus
        />
      </div>

      <div class="flex justify-end mt-4">
        <VButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Confirm
        </VButton>
      </div>
    </form>
  </VCardAuth>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  data() {
    return {
      form: this.$inertia.form({
        password: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.confirm"), {
        onFinish: () => this.form.reset(),
      });
    },
  },
});
</script>
