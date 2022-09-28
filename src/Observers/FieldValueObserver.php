<?php

namespace Taskday\Observers;

use Taskday\Models\FieldValue;
use Illuminate\Support\Arr;

class FieldValueObserver
{
    /**
     * Handle the FieldValue "created" event.
     *
     * @param  \Taskday\Models\FieldValue  $fieldvalue
     * @return void
     */
    public function created(FieldValue $fieldvalue)
    {
        $fieldvalue->entry->registerActivity('field-created', [
            'field_id' => $fieldvalue->field_id,
        ], [
            'old_values' => Arr::get($fieldvalue->getOriginal(), 'value'),
            'new_values' => Arr::get($fieldvalue->getAttributes(), 'value'),
        ]);
    }

    /**
     * Handle the FieldValue "updated" event.
     *
     * @param  \Taskday\Models\FieldValue  $fieldvalue->entry
     * @return void
     */
    public function updated(FieldValue $fieldvalue)
    {
        $fieldvalue->entry->registerActivity('field-updated', [
            'field_id' => $fieldvalue->field_id,
        ], [
            'old_values' => Arr::get($fieldvalue->getOriginal(), 'value'),
            'new_values' => Arr::get($fieldvalue->getAttributes(), 'value'),
        ]);
    }

    /**
     * Handle the FieldValue "deleted" event.
     *
     * @param  \Taskday\Models\FieldValue  $fieldvalue
     * @return void
     */
    public function deleted(FieldValue $fieldvalue)
    {
        $fieldvalue->entry->registerActivity('field-deleted');
    }

    /**
     * Handle the FieldValue "restored" event.
     *
     * @param  \Taskday\Models\FieldValue  $fieldvalue
     * @return void
     */
    public function restored(FieldValue $fieldvalue)
    {
        //
    }

    /**
     * Handle the FieldValue "force deleted" event.
     *
     * @param  \Taskday\Models\FieldValue  $fieldvalue
     * @return void
     */
    public function forceDeleted(FieldValue $fieldvalue)
    {
        //
    }
}
