<script lang="ts" setup>
import { useForm } from '@inertiajs/inertia-vue3';

let props = defineProps<{ 
  view: any, 
  board: any, 
  group?: any 
}>()

let newEntry = useForm({ title: '', board_id: props.board.id });
function submit() {
  newEntry.post(route('entries.store'), {
    onSuccess:() => newEntry.reset(),
    preserveScroll: true
  })
}
</script>

<template>
<div class="">
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
              <th scope="col" v-for="field in board.fields" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                <div class="flex items-center">
                  {{ field.title }}
                  <v-field-menu :field="field" />
                </div>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr v-for="entry in board.entries" class="hover:[&>td]:bg-gray-100">
              <td class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900 pl-2">
                <div class="flex items-center gap-2">
                  <v-entry-menu :entry="entry" /> <Link class="hover:underline" :href="route('entries.show', entry)" v-html="entry.title"></Link>
                </div>
              </td>
              <td v-for="field in board.fields" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                <component
                  :is="taskday().field(field.type).component"
                  :entry="entry"
                  :value="entry.fields.find((f) => f.id == field.id)?.value ?? ''"
                  :field="field"
                ></component>
              </td>
            </tr>
            <tr>
              <td>
                <form @submit.prevent="submit">
                  <v-form-input 
                    v-model="newEntry.title" 
                    placeholder="Add an entry" 
                    class="border-none"
                    :errors="newEntry.errors.title"
                  />
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>
