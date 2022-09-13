<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Taskday\Events\EntryUpdatedEvent;
use Taskday\Models\Concerns\HasFields;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Entry extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;
    use HasFields;

    protected $guarded = [];

    protected $auditInclude = [
        'title',
    ];

    protected $events = [
        'updated' => EntryUpdatedEvent::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, 'fields_values')
            ->using(FieldValue::class)
            ->withPivot('value')
            ->withTimestamps();
    }
}
