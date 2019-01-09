<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function tables() {
        return $this->hasMany('App\Models\Table', 'rest_id');
    }

    public function schedules() {
        return $this->hasMany('App\Models\Schedule', 'rest_id');
    }
}
