import Extension from "@/plugins/interfaces/Extension";
import Plugin from './Plugin'

export default class Taskday {
  private instance;

  private readonly plugins: Plugin[] = [];

  constructor(instance) {
    this.instance = instance;
  }

  plugin(plugin: object) {
    this.plugins.push(new Plugin(plugin));

    console.log('✅ registered plugin', plugin.title)
  }

  fields() {
    return this.plugins.flatMap(plugin => plugin.fields());
  }

  field(type: string): Extension {
    return this.fields().find(view => view.type == type);
  }

  views(): Extension[] {
    return this.plugins.flatMap(plugin => plugin.views());
  }

  view(type: string): Extension {
    return this.views().find(view => view.type == type);
  }

  widgets(): Extension[] {
    return this.plugins.flatMap(plugin => plugin.widgets());
  }

  widget(type: string): Extension {
    return this.widgets().find(widget => widget.type == type);
  }


}
