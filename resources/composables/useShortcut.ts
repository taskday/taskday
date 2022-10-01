import { onMounted } from "vue";
import hotkeys from "hotkeys-js";

export const useShortcut = (shortcut: string, callback) => {
  onMounted(() => {
    hotkeys(shortcut, callback);
  });
};
