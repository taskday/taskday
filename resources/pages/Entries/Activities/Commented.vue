<script lang="ts" setup>
import moment from "moment";
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import VActivity from "@/components/VActivity.vue";

let props = defineProps<{ activity: Activity }>();

const comment = ref({ content: "" });

onMounted(() => {
  axios
    .get(route("api.entries.comments.show", [props.activity.entry_id, props.activity.meta_data.comment_id]))
    .then((res) => {
      comment.value = res.data;
    });
});

const state = reactive({
  content: "",
  editing: false,
  loading: false,
});

function edit() {
  state.content = comment.value.content;
  state.editing = true;
  state.loading = false;
}

function cancel() {
  state.editing = false;
  state.loading = false;
  state.content = '';
}

function save() {
  state.loading = true;
  axios
    .put(route("api.entries.comments.update", [props.activity.entry_id, props.activity.meta_data.comment_id]), {
      content: state.content,
    })
    .then((res) => {
      state.editing = false;
      state.loading = false;
      comment.value = res.data;
    });
}
</script>

<template>
  <VActivity icon="message-circle">
    <div class="flex items-center justify-between">
      <div>
        <span class="text-gray-900 font-medium">
          {{ activity.user.name }}
        </span>
        {{ " " }}
        commented
        {{ " " }}
        <span class="whitespace-nowrap">{{ moment(activity.created_at).fromNow() }}</span>
      </div>
      <div v-if="activity.user.id == $page.props.user.id" class="flex items-center gap-2">
        <v-button @click="edit" v-if="!state.editing && !state.loading"> Edit </v-button>
        <v-button v-if="state.editing" :disabled="state.loading" :loading="state.loading" @click="save">
          Save
        </v-button>
        <v-button @click="cancel" v-if="state.editing"> Cancel </v-button>
        <v-button @click="cancel" class="px-0 hover:text-red-600" v-if="state.editing"> 
          <v-icon name="trash" class="h-5 w-5"></v-icon>
        </v-button>
      </div>
    </div>
    <div class="border p-3 mt-1 text-gray-800">
      <div>
        <v-form-editor
          :toolbar="state.editing"
          v-model="comment.content"
          :editable="state.editing"
        ></v-form-editor>
      </div>
    </div>
  </VActivity>
</template>
