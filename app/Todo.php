<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    public function complete()
    {
        return $this->belongsTo(Complete::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** Mutator */

    public function isTodayCompletedAttribute(): bool
    {
        return $this->completes()
            ->where('edate', now())
            ->exists();
    }
}
