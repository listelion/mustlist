<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    /** Relations */

    public function completes()
    {
        return $this->hasMany(Complete::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Mutator */

    public function isTodayCompletedAttribute(): bool
    {
        return $this->completes()
            ->where('edate', now())
            ->exists();
    }
}
