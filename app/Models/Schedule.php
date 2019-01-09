<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function restaurant() {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
