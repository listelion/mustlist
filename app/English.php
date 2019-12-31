<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class English extends Model
{
    use SoftDeletes;

    public function koreans()
    {
        return $this->belongsToMany('App\Korean');
    }
}
