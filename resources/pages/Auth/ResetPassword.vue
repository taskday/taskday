<template>
  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <v-card>
      <form @submit.prevent="submit" method="post">
        <div>
          <VFormInput
            label="Email"
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            :errors="form.errors.email"
            required
            autofocus
          />
        </div>

        <div class="mt-4">
          <VFormInput
            label="Password"
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            :errors="form.errors.password"
            required
            autocomplete="new-password"
          />
        </div>

        <div class="mt-4">
          <VFormInput
            label="Confirm Password"
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            :errors="form.errors.password_confirmation"
            required
            autocomplete="new-password"
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <VButton class="button-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Reset Password </VButton>
        </div>
      </form>
    </v-card>
  </div>
</template>

<script lang="ts">
import LayoutGuest from "@/layouts/GuestLayout.vue";

export default {
  layout: LayoutGuest,

  props: {
    email: String,
    token: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        token: this.token,
        email: this.email,
        password: "",
        password_confirmation: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.update"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
