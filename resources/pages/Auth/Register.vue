<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2
        class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100"
      >
        Create a new account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <v-card>
        <form class="space-y-6" action="#" method="POST">
          <v-form-input
            label="Name"
            id="name"
            name="name"
            type="name"
            autocomplete="name"
            required=""
          />

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

          <v-form-input
            label="Confirm Password"
            id="password"
            name="password_confirmation"
            type="password"
            required=""
          />

          <div>
            <button type="submit" class="button">Register</button>
          </div>
        </form>
      </v-card>

      <div class="flex items-center justify-center mt-6">
        <div class="text-sm">
          <a href="/login" class="link">Already have an account?</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import GuestLayout from "@/layouts/GuestLayout.vue";

export default defineComponent({
  layout: GuestLayout,
  data() {
    console.log(this.$page.props);
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        _token: this.$page.props.csrf_token,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password"),
      });
    },
  },
});
</script>
