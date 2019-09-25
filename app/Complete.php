<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complete extends Model
{
    use SoftDeletes;

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
