<?php

namespace Taskday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Member extends MorphPivot
{
    protected $table = 'members';

    protected $with = ['user'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the commentable entity that the member belongs to.
     *
     * @return mixed
     */
    public function memberable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * User related to this member model.
     *
     * @return mixed
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('taskday.user.model'));
    }
}
