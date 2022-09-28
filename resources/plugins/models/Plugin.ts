import Extension from "@/plugins/interfaces/Extension";

export default class Plugin {

  public data: object

  constructor(data: object) {
    this.data = data
  }

  views(): Extension[] {
    return this.data.views;
  }

  fields(): Extension[] {
    return this.data.fields;
  }

  filters(): Extension[] {
    return [];
  }
}
