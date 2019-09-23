<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public function completes()
    {
        return $this->hasMany('App\Complete');
    }
}
