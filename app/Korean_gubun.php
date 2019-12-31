<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Korean_gubun extends Model
{
    use SoftDeletes;
    public function koreans()
    {
        return $this->hasMany(Korean::class);
    }
}
