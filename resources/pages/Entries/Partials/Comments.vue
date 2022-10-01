<script lang="ts" setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";

let props = defineProps<{ entry: Entry }>();
let page = usePage();

const form = useForm({ content: "" });

function submit() {
  form.post(route("entries.comments.store", props.entry), {
    onSuccess: () => {
      form.content = "";
    },
  });
}
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
        <form @submit.prevent="submit">
          <div>
            <label for="comment" class="sr-only">Comment</label>
            <v-form-editor
              placeholder="Leave a comment"
              v-model="form.content"
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
