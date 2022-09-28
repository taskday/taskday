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

  views(): Extension[] {
    return this.plugins.flatMap(plugin => plugin.views());
  }

  view(type: string): Extension {
    return this.views().find(view => view.type == type);
  }

  field(type: string): Extension {
    return this.fields().find(view => view.type == type);
  }
}
