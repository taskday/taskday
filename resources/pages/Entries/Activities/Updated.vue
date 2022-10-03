<script lang="ts" setup>
import moment from "moment";
import VActivity from "@/components/VActivity.vue";

defineProps<{ activity: Activity }>();
</script>

<template>
  <VActivity icon="user">
    <span class="text-gray-900 font-medium">
      {{ activity.user.name }}
    </span>
    {{ " " }}
    updated
    {{ " " }}
    <template v-for="(value, key) in activity.new_values">
      <template v-if="key != 'content'">
        <span class="font-medium text-gray-900">{{ key }}</span>
        {{ " " }}
        from
        {{ " " }}
        <span class="font-medium text-gray-900 inline-block line-through" v-html="activity.old_values[key]"></span>
        {{ " " }}
        to
        {{ " " }}
        <span class="font-medium text-gray-900 inline-block" v-html="value"></span>
      </template>
      <template v-else>
        <span class="font-medium text-gray-900">{{ key }}</span>
      </template>
    </template>
    {{ " " }}
    <span class="whitespace-nowrap">{{ moment(activity.created_at).fromNow() }}</span>
  </VActivity>
</template>
