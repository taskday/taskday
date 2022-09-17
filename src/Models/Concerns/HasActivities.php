<?php

namespace Taskday\Models\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

trait HasActivities
{
    public function isWatchedAttribute(string $attribute): bool
    {
        return in_array($attribute, $this->watch);
    }

    public function registerActivity(string $name, array $meta = []): self
    {
        $old = [];
        $new = [];

        foreach ($this->getDirty() as $attribute => $value) {
            if ($this->isWatchedAttribute($attribute)) {
                $old[$attribute] = Arr::get($this->original, $attribute);
                $new[$attribute] = Arr::get($this->attributes, $attribute);
            }
        }

        $this->activities()->create([
            'event' => $name,
            'old_values' => array_filter($old),
            'new_values' => array_filter($new),
            'meta_data' => $meta,
        ]);

        return $this;
    }
}
