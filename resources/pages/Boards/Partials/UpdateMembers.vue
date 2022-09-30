<template>
  <VFormSection @submitted="submit">
    <template #title>Member</template>
    <template #description>All members of this project</template>
    <template #content>
      <div v-for="member in board.members">
        <div class="flex items-center justify-between">
          <div>
            <p>{{ member.first_name }} {{ member.last_name }}</p>
            <p class="text-sm text-gray-600">{{ member.email }}</p>
          </div>
          <VButton type="button" @click.prevent="toggle(member)">
            Remove
          </VButton>
        </div>
      </div>
      <div>
        <v-form-input v-model="search.query" placeholder="Search a .."></v-form-input>
        <!-- TODO: search users and add them to members -->
      </div>
    </template>
  </VFormSection>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';

let props = defineProps<{ board: any }>();

const form = useForm({
  members: [],
})

const search = useForm({
  query: '',
})

onMounted(() => {
  form.members = props.board.members.map(m => m.id)
})

function toggle(user: User) {
  if (form.members.includes(user.id)) {
    form.members = form.members.filter(id => id !== user.id);
  } else {
    form.members.push(user.id);
  }
}

function submit() {
  form.post(route('boards.members-update', ));
}
</script>
