<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2
        class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100"
      >
        Verify your email to continue
      </h2>
    </div>
    
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="text-center">
      <p class="mt-1 text-sm text-gray-500">Didn't receive an email?</p>
      <div class="mt-6">
        <button @click="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          Resend
        </button>
      </div>
      <p v-if="message" class="mt-1 text-sm text-gray-500">{{ message }}</p>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import GuestLayout from "@/layouts/GuestLayout.vue";

export default defineComponent({
  layout: GuestLayout,
  data() {
    return {
      message: '',
      form: this.$inertia.form({
        _token: this.$page.props.csrf_token,
      }),
    };
  },
  methods: {
    submit() {
      this.form
        .post(this.route("verification.send"), {
          onFinish: () => this.message = 'Email sent!',
        });
    },
  },
});
</script>
