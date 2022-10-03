import Taskday from "@/plugins/models/Taskday";

export default {
  install(app, options) {    
    const taskday = new Taskday(app);
    
    console.log('🚀 boostraping...');
    //@ts-ignore
    window.taskday = taskday;
    app.config.globalProperties.taskday = () => window.taskday;
    app.mixin({
      methods: {
        taskday(): Taskday {
          return window.taskday;
        }
      }
    })
    console.log('🔌 loading plugins...');
    document.dispatchEvent(
      new CustomEvent("taskday:init", {
        detail: {},
        bubbles: true,
        composed: true,
        cancelable: false,
      })
    );
  }
};
