import { Inertia } from "@inertiajs/inertia";
import { get, cloneDeep } from "lodash";

export interface FieldData {
  handle: string;
  title: string;
}

export class Field {
  public readonly data: FieldData;

  constructor(data: FieldData) {
    this.data = cloneDeep(data);
  }

  getValue(data): string {
    return data.customFields[this.data.handle]?.pivot?.value;
  }

  setValue(data, value): void {
    try {
      Inertia.put(route('cards.fields.update', [data, this.data]), {
        value
      })
    } catch(error) {
      console.error(error)
    }
  }
}
