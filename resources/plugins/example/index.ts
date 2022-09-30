import Taskday from "@/plugins/models/Taskday";
import TableView from "./TableView.vue";
import KanbanView from "./KanbanView.vue";
import ProgressField from "./ProgressField.vue";
import IssueField from "./IssueField.vue";
import LabelFieldOptions from './LabelFieldOptions.vue';

window.addEventListener("taskday:init", function () {
  //@ts-ignore
  let taskday: Taskday = window.taskday;

  taskday.plugin({
    title: "Sample",
    views: [
      { type: "table", component: TableView },
      { type: "kanban", component: KanbanView },
    ],
    fields: [
      { type: "progress", component: ProgressField },
      { type: "label", component: ProgressField, options: LabelFieldOptions },
      { type: "issue", component: IssueField },
    ],
  });
});
