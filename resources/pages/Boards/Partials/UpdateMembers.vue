<template>
  <VFormSection @submitted="submit">
    <template #title>Member</template>
    <template #description>All members of this project</template>
    <template #content>
      <div v-for="member in form.members">
        <div class="flex items-center justify-between">
          <div>
            <p>{{ member.first_name }} {{ member.last_name }}</p>
            <p class="text-sm text-gray-600">{{ member.email }}</p>
          </div>
          <VButton type="button" @click.prevent="remove(member)"> Remove </VButton>
        </div>
      </div>
      <div>
        <div v-for="user in users.filter(user => !form.members.map(member => member.id).includes(user.id) )">
          <div class="flex items-center">
            <span>{{ user.name }}</span>
            <v-button @click="add(user)"> Add </v-button>
          </div>
        </div>
      </div>
      <v-button type="button" @click="submit" class="button-primary"> Save </v-button>
    </template>
  </VFormSection>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

let props = defineProps<{ board: any; users: User[] }>();

const form = useForm({
  members: props.board.members,
});

const search = useForm({
  query: "",
});

onMounted(() => {});

function remove(user: User) {
  form.members = form.members.filter((member) => member.id !== user.id);
}

function add(user: User) {
  form.members.push(user);
}

function submit() {
  form
    .transform(function (state) {
      return { members: state.members.map((member) => member.id) };
    })
    .put(route("boards.update-members", props.board));
}
</script>
