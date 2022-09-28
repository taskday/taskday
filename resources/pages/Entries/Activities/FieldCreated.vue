<script lang="ts" setup>
import moment from "moment";
import VActivity from "@/components/VActivity.vue";
import { computed } from "@vue/reactivity";

let props = defineProps<{ activity: Activity; entry: Entry }>();

const field = computed(() =>
  props.entry.fields.find((f) => f.id === props.activity.meta_data.field_id)
);
</script>

<template>
  <VActivity icon="user">
    <span class="text-gray-900 font-medium">
      {{ activity.user.name }}
    </span>
    {{ " " }}
    created field {{ field.title }}
    {{ " " }}
    <span class="whitespace-nowrap">{{
      moment(activity.created_at).fromNow()
    }}</span>
  </VActivity>
</template>
