<script lang="ts" setup>
import moment from 'moment';
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

const page = usePage();

const form = useForm({
  first_name: page.props.value.user.first_name,
  last_name: page.props.value.user.last_name,
  username: page.props.value.user.username,
  email: page.props.value.user.email,
});

const previewProfileUrl = ref(page.props.value.user.profile_photo_url);

function submit() {
  form.put(route("account.update"));
}
</script>

<template>
  <div>
    <div class="mx-auto max-w-3xl py-6 xl:py-8 px-4 sm:px-6">
      <h1 class="text-2xl font-bold text-gray-900">
        {{ $page.props.title }}
      </h1>
      <form
        @submit.prevent="submit"
        class="divide-y-blue-gray-200 mt-6 space-y-8 divide-y"
      >
        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
          <div class="sm:col-span-6">
            <h2 class="text-xl font-medium text-blue-gray-900">Profile</h2>
            <p class="mt-1 text-sm text-blue-gray-500"></p>
          </div>

          <!-- <div class="sm:col-span-6">
            <label
              for="photo"
              class="block text-sm font-medium text-blue-gray-900"
              >Photo</label
            >
            <div class="mt-1 flex items-center">
              <img
                class="inline-block h-12 w-12 rounded-full"
                :src="previewProfileUrl"
                alt=""
              />
              <div class="ml-4 flex">
                <div
                  class="relative flex cursor-pointer items-center rounded-md border border-blue-gray-300 bg-white py-2 px-3 shadow-sm focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 focus-within:ring-offset-blue-gray-50 hover:bg-blue-gray-50"
                >
                  <label
                    for="user-photo"
                    class="pointer-events-none relative text-sm font-medium text-blue-gray-900"
                  >
                    <span>Change</span>
                    <span class="sr-only"> user photo</span>
                  </label>
                  <input
                    @input="form.profile_path = $event.target.files[0]"
                    @change="previewProfileUrl.value = $event.target.files[0]"
                    id="user-photo"
                    type="file"
                    class="absolute inset-0 h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0"
                  />
                </div>
                <button
                  type="button"
                  class="ml-3 rounded-md border border-transparent bg-transparent py-2 px-3 text-sm font-medium text-blue-gray-900 hover:text-blue-gray-700 focus:border-blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-blue-gray-50"
                >
                  Remove
                </button>
              </div>
            </div>
          </div> -->

          <div class="sm:col-span-3">
            <v-form-input
              label="First name"
              v-model="form.first_name"
              type="text"
              name="first-name"
              id="first-name"
              autocomplete="given-name"
            />
          </div>

          <div class="sm:col-span-3">
            <v-form-input
              label="Last name"
              v-model="form.last_name"
              type="text"
              name="last-name"
              id="last-name"
              autocomplete="family-name"
            />
          </div>

          <div class="sm:col-span-6">
            <v-form-input
              label="Username"
              type="text"
              name="username"
              autocomplete="username"
              v-model="form.username"
            />
          </div>
        </div>

        <div class="grid grid-cols-1 gap-y-6 pt-8 sm:grid-cols-6 sm:gap-x-6">
          <div class="sm:col-span-6">
            <h2 class="text-xl font-medium text-blue-gray-900">
              Personal Information
            </h2>
            <p class="mt-1 text-sm text-blue-gray-500">
            </p>
          </div>

          <div class="sm:col-span-3">
            <v-form-input
              label="Email address"
              type="text"
              name="email-address"
              id="email-address"
              autocomplete="email"
              v-model="form.email"
            />
            <span class="text-sm text-red-700/90" v-if="$page.props.user.email_verified_at == null">
              Verify your email, click the link you received to ensure you can recover your account. Check also your spam folder or 
              <Link class="hover:underline" method="post" :href="route('account.verification.send')">send again</Link>.
            </span>
          </div>

          <div class="sm:col-span-3">
            <v-form-select
              label="Language"
              type="text"
              name="language"
              id="language"
            >
              <option value="en">English</option>
              <option value="it">Italian</option>
            </v-form-select>
          </div>

          <p class="text-sm text-blue-gray-500 sm:col-span-6">
            This account was created on
            <time datetime="2017-01-05T20:35:40">
              {{ 
                // @ts-ignore
                moment($page.props.user.created_at).format('MMMM Do YYYY, h:mm') 
              }}
            </time>.
          </p>
        </div>

        <div class="flex pt-8">
          <v-button
            type="submit"
            class="button-primary"
          >
            Save
          </v-button>
        </div>
      </form>
    </div>
  </div>
</template>
