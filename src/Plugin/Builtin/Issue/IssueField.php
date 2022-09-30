<?php

namespace Taskday\Plugin\Builtin\Issue;

use Taskday\Plugin\Types\FieldType;
use Taskday\Plugin\Contracts\Actionable;
use Taskday\Plugin\Support\HasActions;
use Illuminate\Support\Facades\Event;
use Taskday\Events\EntryCreatedEvent;
use Illuminate\Support\Collection;
use Taskday\Models\Field;
use Taskday\Models\Board;

class IssueField extends FieldType implements Actionable
{
    use HasActions;

    public string $type = 'issue';

    public function boot()
    {
        Event::listen(EntryCreatedEvent::class, function (EntryCreatedEvent $event) {
            foreach ($event->entry->board->fields as $field) {
                if ($field->type == $this->type) {
                    $event->entry->setFieldValue($field, $this->nextValueFor($field, $event->entry->board));
                }
            }
        });
    }

    public function actions(): Collection
    {
        return collect([
            'generate' => new GenerateAction(),
        ]);
    }

    public function nextValueFor(Field $field, Board $board)
    {
        $values = $board->entries->map(fn ($entry) => $entry->getRawFieldValue($field));
        $nextValue = $board->entries->count();

        if ($values->contains($nextValue)) {
            $nextValue = $values->max() + 1;
        }

        return $nextValue;
    }
}
