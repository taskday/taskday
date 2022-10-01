<template>
  <div class="">
    <div class="text-gray-700 dark:text-gray-100">
      <div v-if="toolbar && editor" class="flex flex-wrap">
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().insertTable().run()"
            :class="{ 'is-active': editor.isActive('bold') }"
          >
            <VIcon class="w-4 h-4" name="table" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().addColumnAfter().run()"
            :class="{ 'is-active': editor.isActive('bold') }"
          >
            <VIcon class="w-4 h-4" name="plus" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleBold().run()"
            :class="{ 'is-active': editor.isActive('bold') }"
          >
            <VIcon class="w-4 h-4" name="bold" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleItalic().run()"
            :class="{ 'is-active': editor.isActive('italic') }"
          >
            <VIcon class="w-4 h-4" name="italic" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().setParagraph().run()"
            :class="{ 'is-active': editor.isActive('paragraph') }"
          >
            <VIcon class="w-4 h-4" name="type" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
          >
            h1
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
          >
            h2
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
          >
            h3
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleBulletList().run()"
            :class="{ 'is-active': editor.isActive('bulletList') }"
          >
            <VIcon class="w-4 h-4" name="list" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleTaskList().run()"
            :class="{ 'is-active': editor.isActive('taskList') }"
          >
            <VIcon class="w-4 h-4" name="check-square" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().toggleCodeBlock().run()"
            :class="{ 'is-active': editor.isActive('codeBlock') }"
          >
            <VIcon class="w-4 h-4" name="code" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().undo().run()"
          >
            <VIcon class="w-4 h-4" name="corner-up-left" />
          </button>
        </div>
        <div class="p-2">
          <button
            type="button"
            class="flex items-center justify-center bg-gray-100 rounded dark:bg-gray-700 h-7 w-7"
            @click="editor.chain().focus().redo().run()"
          >
            <VIcon class="w-4 h-4" name="corner-up-right" />
          </button>
        </div>
      </div>
    </div>
    <span class="ProseMirror"></span>
    <EditorContent
      v-bind="$attrs"
      :editor="editor"
    />
  </div>
</template>

<script lang="ts">
import { onBeforeUnmount, watch, ref, defineComponent } from "vue";
import { useEditor, EditorContent } from "@tiptap/vue-3";
import { Extension } from '@tiptap/core'

import Document from "@tiptap/extension-document";
import Heading from "@tiptap/extension-heading";
import Paragraph from "@tiptap/extension-paragraph";
import Text from "@tiptap/extension-text";
import Bold from "@tiptap/extension-bold";
import Strike from "@tiptap/extension-strike";
import Italic from "@tiptap/extension-italic";
import TaskList from "@tiptap/extension-task-list";
import TaskItem from "@tiptap/extension-task-item";
import ListItem from "@tiptap/extension-list-item";
import BulletList from "@tiptap/extension-bullet-list";
import OrderedList from "@tiptap/extension-ordered-list";
import CodeBlock from "@tiptap/extension-code-block";
import History from "@tiptap/extension-history";
import Placeholder from "@tiptap/extension-placeholder";
import HardBreak from "@tiptap/extension-hard-break";
import Link from "@tiptap/extension-link";
import Mention from "@tiptap/extension-mention";
import Table from "@tiptap/extension-table";
import TableRow from "@tiptap/extension-table-row";
import TableHeader from "@tiptap/extension-table-header";
import TableCell from "@tiptap/extension-table-cell";

export default defineComponent({
  inheritAttrs: false,

  components: {
    EditorContent,
  },

  props: {
    modelValue: {
      type: String,
      default: "",
    },
    content: {
      type: String,
    },
    onChange: {
      type: Function,
    },
    toolbar: {
      type: Boolean,
      default: true,
    },
    editable: {
      type: Boolean,
      default: true,
    },
    placeholder: {
      type: String,
      default: null,
    },
  },

  setup(props, ctx) {

    const editor = ref(
      useEditor({
        editable: props.editable,
        content: props.modelValue,
        extensions: [
          Document,
          Heading,
          Paragraph,
          Text,
          Bold,
          Link,
          Strike,
          Italic,
          TaskList,
          TaskItem.configure({
            nested: true,
          }),
          ListItem,
          BulletList,
          OrderedList,
          CodeBlock,
          Placeholder.configure({
            placeholder: props.placeholder ?? "Write something...",
          }),
          HardBreak,
          History,
          Table.configure({
            resizable: true,
          }),
          TableRow,
          TableHeader,
          TableCell,
          Extension.create({
            onBlur({ event }) {
              ctx.emit('blur')
            },
          }),
        ],
        onUpdate: ({ editor }) => {
          ctx.emit("update:modelValue", editor.getHTML());
        },
      })
    );

    watch(
      () => props.modelValue,
      (value) => {
        if (editor) {

          const noChanges = editor.value.getHTML() === value;

          if (noChanges) { return; }

          editor.value.commands.setContent(props.modelValue, false);
        }
      }
    );

    watch(
      () => props.editable,
      (value) => {
        if (editor) {
          editor.value.setEditable(value);
        }
      }
    );

    onBeforeUnmount(() => {
      editor?.value?.destroy();
    });

    return { editor };
  },
});
</script>
