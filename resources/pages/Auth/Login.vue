<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2
        class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100"
      >
        Sign in to your account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <v-card>
        <form class="space-y-6" action="#" method="POST">
          <v-form-input
            label="Email Address"
            id="email"
            name="email"
            type="email"
            autocomplete="email"
            required=""
          />

          <v-form-input
            label="Password"
            id="password"
            name="password"
            type="password"
            required=""
          />

          <div class="flex items-center justify-between">
            <v-form-checkbox
              label="Remember me"
              id="checkbox"
              name="checkbox"
              type="checkbox"
              required=""
            />

            <div class="text-sm">
              <a href="#" class="link">Forgot your password?</a>
            </div>
          </div>

          <div>
            <button type="submit" class="button">Sign in</button>
          </div>
        </form>
      </v-card>
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
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
        _token: this.$page.props.csrf_token,
      }),
    };
  },
  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
});
</script>
