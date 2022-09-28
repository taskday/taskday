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
      updated field
      {{ " " }}
      <template v-for="(value, key) in activity.new_values">
        {{ " " }}
        <span class="font-medium text-gray-900">{{ field.title }}</span>
        {{ " " }}
        from
        {{ " " }}
        <component 
          :is="taskday().field(field.type).component"
          :entry="entry"
          :field="field" 
          :value="activity.old_values[key]"
          :readonly="true"
        ></component>
        {{ " " }}
        to
        {{ " " }}
        <component 
        :is="taskday().field(field.type).component"
        :entry="entry"
        :field="field" 
        :value="value"
        :readonly="true"
        ></component>
      </template>
      {{ " " }}
      <span class="whitespace-nowrap">{{ moment(activity.created_at).fromNow() }}</span>
    </VActivity>
  </template>
  