import Taskday from "@/plugins/models/Taskday"

declare global {
  function taskday(): Taskday;
  function route(route?: string, params?: any): string;
  interface Window {
    taskday: Taskday
  }
}

export {}
