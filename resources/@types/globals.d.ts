import Taskday from "@/plugins/models/Taskday"

export {}

declare global {
    function route(route?: string, params?: any): string;

    interface Window {
      taskday: Taskday
    }
}
