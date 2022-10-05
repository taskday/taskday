import Extension from "@/plugins/interfaces/Extension";

export default class Plugin {

  public data: any

  constructor(data: any) {
    this.data = data
  }

  views(): Extension[] {
    return this.data.views;
  }

  fields(): Extension[] {
    return this.data.fields;
  }

  widgets(): Extension[] {
    return this.data.widgets;
  }

  filters(): Extension[] {
    return this.data.filters;
  }
}
