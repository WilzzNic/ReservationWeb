<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    public function restaurant() {
        return $this->belongsTo('App\Models\Restaurant', 'rest_id');
    }
}
