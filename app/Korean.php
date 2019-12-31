<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Korean extends Model
{
    use SoftDeletes;

    public function englishes()
    {
        return $this->belongsToMany('App\English');
    }

    public function gubun()
    {
        return $this->belongsTo(Korean_gubun::class);
    }
}
