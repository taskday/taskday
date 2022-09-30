<?php

namespace Taskday\Models\Concerns;

use Taskday\Models\Field;
use Taskday\Exceptions\UnkownFieldException;
use Taskday\Models\FieldValue;

trait HasFields
{
    public function setFieldValue(Field|string $id, string $value): void
    {
        if (is_string($id)) {
            $field = Field::find($id);
        } else {
            $field = $id;
        }

        if (! $field) {
            throw new UnkownFieldException("Field with id of $id not found");
        }

        $this->fields()->syncWithoutDetaching([
            $field->id => ['value' => $value]
        ]);
    }

    public function getFieldValue(Field $field): ?FieldValue
    {
        return $this->fields()->where('field_id', $field->id)->first()?->pivot;
    }

    public function getRawFieldValue(Field $field): ?string
    {
        $fieldValue = $this->getFieldValue($field);

        return $fieldValue?->value;
    }
}
