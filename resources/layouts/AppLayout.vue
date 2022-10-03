<template>
  <div>
    <!-- Drawer sidebar for mobile -->
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog
        as="div"
        class="relative z-40 md:hidden"
        @close="sidebarOpen = false"
      >
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-300"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>

        <div class="fixed inset-0 z-40 flex">
          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="-translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="-translate-x-full"
          >
            <DialogPanel
              class="relative flex w-full max-w-xs flex-1 flex-col bg-blue-800 pt-5 pb-4"
            >
              <TransitionChild
                as="template"
                enter="ease-in-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
              >
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                  <button
                    type="button"
                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    @click="sidebarOpen = false"
                  >
                    <span class="sr-only">Close sidebar</span>
                    <v-icon
                      name="x"
                      class="h-6 w-6 text-white"
                      aria-hidden="true"
                    />
                  </button>
                </div>
              </TransitionChild>
              <Sidebar />
            </DialogPanel>
          </TransitionChild>
          <div class="w-14 flex-shrink-0" aria-hidden="true">
            <!-- Dummy element to force sidebar to shrink to fit close icon -->
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-grow flex-col overflow-y-auto bg-blue-800 pt-5">
        <Sidebar />
      </div>
    </div>

    <!-- Header and Content -->
    <div class="flex flex-1 flex-col md:pl-64">
      <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white shadow">
        <button
          type="button"
          class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 md:hidden"
          @click="sidebarOpen = true"
        >
          <span class="sr-only">Open sidebar</span>
          <v-icon name="menu" class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex flex-1 items-center gap-3 justify-between px-4">
          <div class="items-center flex">
            <v-breadcrumbs :pages="$page.props.breadcrumbs ?? []" class="hidden md:flex"/>
          </div>
          <div class="flex items-center gap-3">
            <!-- Search -->
            <v-search></v-search>
            <!-- Notifications -->
            <div class="h-6 w-6">
              <v-popover>
                <button
                  type="button"
                  class="rounded-full h-6 w-6 flex-1 flex items-center justify-center bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                  <span class="sr-only">View notifications</span>
                  <v-icon name="bell" class="h-6 w-6" aria-hidden="true" />
                </button>
                <template #content="{ close }">
                  <span class="text-gray-500">
                    <div class="overflow-x-hidden divide-y">
                      <div v-if="notifications.notifications.length > 0" class="flex items-center justify-end">
                        <button @click="notifications.markAllRead()" class="button button-sm">
                          Dimiss all
                        </button>
                      </div>
                      <div v-for="notification in notifications.notifications" class="py-2 last:pb-0">
                        <div>
                          <div class="flex items-start">
                            <div class="flex-shrink-0">
                              <v-icon name="message-circle" class="h-6 w-6 text-gray-400" aria-hidden="true" />
                            </div>
                            <div class="ml-2">
                              <p class="text-sm font-medium text-gray-900">{{ notification.title }}</p>
                              <p class="mt-1 text-sm text-gray-500">{{ notification.body }}</p>
                              <div class="mt-2 flex space-x-3">
                                <Link :onSuccess="close" :href="notification.url" class="button button-sm h-7 text-blue-600">View</Link>
                                <button type="button" @click="notifications.markAsRead(notification)" class="button button-sm h-7 text-gray-600">Dismiss</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div v-if="notifications.notifications.length == 0">
                        <div class="text-center w-full">
                          <span class="text-sm">No new notifications.</span>
                        </div>
                      </div>
                    </div>
                  </span>
                </template>
              </v-popover>
            </div>
            <!-- Profile dropdown -->
            <Menu as="div" class="relative">
              <div>
                <MenuButton
                  class="flex max-w-xs items-center rounded-full h-6 w-6 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                  <span class="sr-only">Open user menu</span>
                  <img
                    class="h-6 w-6 rounded-full"
                    :src="$page.props.user.profile_photo_url"
                    alt=""
                  />
                </MenuButton>
              </div>
              <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
              >
                <MenuItems
                  class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                  <div class="px-4 py-3">
                    <p class="text-sm">Signed in as</p>
                    <p class="truncate text-sm font-medium text-gray-900">
                      {{ $page.props.user.email }}
                    </p>
                  </div>
                  <hr />
                  <MenuItem
                    v-for="item in userNavigation"
                    :key="item.name"
                    v-slot="{ active }"
                  >
                    <Link
                      :href="item.href"
                      :class="[
                        active ? 'bg-gray-100' : '',
                        'block px-4 py-2 text-sm text-gray-700',
                      ]"
                    >
                      {{ item.name }}
                    </Link>
                  </MenuItem>
                  <hr />
                  <MenuItem v-slot="{ active }">
                    <Link
                      :href="route('logout')"
                      method="post"
                      as="button"
                      type="button"
                      :class="[
                        active ? 'bg-gray-100' : '',
                        'block w-full text-left px-4 py-2 text-sm text-gray-700',
                      ]"
                    >
                      Sign out
                    </Link>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
      </div>
      <main>
        <div class="py-6">
          <div class="mx-auto container px-4 sm:px-6 md:px-8">
            <slot></slot>
          </div>
        </div>
      </main>
    </div>
    <v-page-modal />
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";

import {
  Dialog,
  DialogPanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

import Sidebar from './Partials/Sidebar.vue';

import { useNotificationsStore } from '@/store/notifications';

const notifications = useNotificationsStore()

onMounted(() => {
  notifications.fetch();
  notifications.listen();
})

const userNavigation = [{ name: "Account", href: route("account") }];

const sidebarOpen = ref(false);
</script>

<style lang="postcss">
  html, body {
    @apply bg-white dark:bg-gray-900;
  }
</style>
