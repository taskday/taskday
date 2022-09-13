<script lang="ts" setup>
import { usePage } from '@inertiajs/inertia-vue3';

defineProps<{ entry: Entry }>();

let page = usePage();
</script>

<template>
  <div class="mt-6">
    <div class="flex space-x-3">
      <div class="flex-shrink-0">
        <div class="relative">
          <img
            class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white"
            :src="page.props.value.user.profile_photo_url"
            alt=""
          />
          <span
            class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px"
          >
            <v-icon
              name="message-square"
              class="h-5 w-5 text-gray-400 bg-gray-100"
              aria-hidden="true"
            />
          </span>
        </div>
      </div>
      <div class="min-w-0 flex-1">
        <form action="#">
          <div>
            <label for="comment" class="sr-only">Comment</label>
            <textarea
              id="comment"
              name="comment"
              rows="3"
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm"
              placeholder="Leave a comment"
            />
          </div>
          <div class="mt-6 flex items-center justify-end space-x-4">
            <v-button type="submit" class="button-primary"> Comment </v-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
