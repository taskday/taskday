<script lang="ts" setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { useForm } from "@inertiajs/inertia-vue3";

const navigation = [
  {
    name: "Dashboard",
    href: route("dashboard"),
    icon: "home",
    current: () => route().current() == "dashboard",
  },
  {
    name: "All Entries",
    href: route("entries.index"),
    icon: "list",
    current: () => route().current() == "entries.index",
  },
];

const newCategory = useForm({
  title: "",
});

function submit() {
  newCategory.post(route("categories.store"), {
    onSuccess: () => newCategory.reset(),
    preserveScroll: true,
    preserveState: false,
  });
}
</script>

<template>
  <div>
    <div class="flex flex-grow flex-col overflow-y-auto bg-blue-800 pt-5">
      <div class="flex flex-shrink-0 items-center px-4 text-white font-bold">
        Taskday
      </div>
      <div class="mt-5 flex flex-1 flex-col">
        <nav class="space-y-1 px-2 pb-4">
          <Link
            v-for="item in navigation"
            :key="item.name"
            :href="item.href"
            :class="[
              item.current()
                ? 'bg-blue-800 text-white'
                : 'text-blue-100 hover:bg-blue-600',
              'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
            ]"
          >
            <v-icon
              :name="item.icon"
              class="mr-3 h-6 w-6 flex-shrink-0 text-blue-300"
              aria-hidden="true"
            />
            {{ item.name }}
          </Link>
        </nav>
        <hr />
        <nav class="flex-1 space-y-1 p-2 pb-4">
          <template v-for="category in $page.props.sidebar.items">
            <Link
              :href="route('categories.show', category)"
              class="group relative flex items-center justify-between py-1 text-xs font-bold rounded-md text-blue-100 hover:bg-blue-600"
            >
              <div class="flex items-center gap-1">
                <v-icon name="chevron-down" class="h-4 w-4"></v-icon>  <span class="truncate" v-html="category.title" />
              </div>
              <v-popper v-slot="{ setPopperRoot, setPopperElement }">
                <Menu>
                  <MenuButton as="button" :ref="setPopperRoot" class="relative flex items-center justify-center w-4 h-6 text-gray-200 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex">
                    <v-icon name="more-vertical" class="w-4 h-4 fill-current" />
                  </MenuButton>
                  <MenuItems>
                    <div :ref="setPopperElement" class="bg-white z-50 text-gray-800 min-w-[12rem] rounded-md shadow-lg p-1 background-200 ring-1 ring-black ring-opacity-5 focus:outline-none max-h-[400px] overflow-auto">
                      <MenuItem v-slot="{ active, selected }">
                        <a :class='{ "bg-gray-100": active }' class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2" href="/account-settings">
                          <v-icon name="edit" class="h-4"></v-icon>Rename
                        </a>
                      </MenuItem>
                      <MenuItem v-slot="{ active, selected }">
                        <Link :class='{ "bg-gray-100": active }' class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2" href="/account-settings">
                          <v-icon name="settings" class="h-4"></v-icon> Settings
                        </Link>
                      </MenuItem>
                      <div class="my-1 px-1 h-px bg-gray-200 w-full" />
                      <MenuItem v-slot="{ active, selected }">
                        <Link method="delete" :class='{ "bg-gray-100 text-red-600": active }' class="group flex w-full items-center gap-2 text-sm rounded cursor-pointer p-2" :href="route('categories.destroy', category)">
                          <v-icon name="trash" class="h-4"></v-icon> Delete
                        </Link>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </Menu>
              </v-popper>
            </Link>
            <Link
              v-if="$page.props.sidebar.show_boards"
              v-for="board in category.boards"
              :key="board.id"
              :href="route('boards.show', board)"
              class="group relative flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md text-blue-100 hover:bg-blue-600"
            >
              <div class="flex items-center gap-1">
                <v-icon
                  name="hash"
                  class="h-4 w-4 flex-shrink-0 text-blue-300"
                  aria-hidden="true"
                />
                <span class="truncate" v-html="board.title" />
              </div>
            </Link>
          </template>
          
          <form @submit.prevent="submit" class="block mt-1">
            <v-form-input
              v-model="newCategory.title"
              :errors="newCategory.errors.title"
              class="bg-blue-600 text-white border-none placeholder:text-white/80"
              placeholder="Add category..."
            />
          </form>
        </nav>
      </div>
    </div>
  </div>
</template>
