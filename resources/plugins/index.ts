import Taskday from "@/plugins/models/Taskday";

export default {
  install(app, options) {    
    const taskday = new Taskday(app);
    
    console.log('🚀 boostraping...');
    window.taskday = taskday;
    app.config.globalProperties.taskday = () => window.taskday;

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
