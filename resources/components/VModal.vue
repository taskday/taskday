<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>
    <div @click="open = true">
      <slot></slot>
    </div>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden w-full rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="sm:flex w-full sm:items-start">
                    <div class="mt-3 w-full text-center sm:mt-0 sm:text-left">
                      <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">{{ title }}</DialogTitle>
                      <div class="mt-2 w-full">
                        <slot name="content" :close="close"></slot>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 gap-3 py-3 flex-col flex sm:flex-row-reverse sm:px-6">
                  <slot name="actions" :close="close"></slot>
                  <v-button type="button" class="button-secondary" @click="open = false" ref="cancelButtonRef">Cancel</v-button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';


let props = defineProps({
  title: {
    type: String,
    default: '',
  },
  description: {
    type: String,
    default: '',
  },
  open: {
    type: Boolean,
    default: false,
  }
})

const open = ref(props.open);

function close() {
  open.value = false
}
</script>
