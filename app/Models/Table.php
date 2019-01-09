<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function restaurant() {
        return $this->belongsTo('App\Models\Restaurant', 'rest_id');
    }
}
