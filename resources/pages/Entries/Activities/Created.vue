<script lang="ts" setup>
import moment from "moment";
import VActivity from "@/components/VActivity.vue";

let props = defineProps<{ activity: Activity }>();
</script>

<template>
  <VActivity icon="user">
    <span class="text-gray-900 font-medium">
      {{ activity.user.name }}
    </span>
    {{ " " }}
    created entry
    {{ " " }}
    <span class="whitespace-nowrap">{{ moment(activity.created_at).fromNow() }}</span>
  </VActivity>
</template>
