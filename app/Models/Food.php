<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
  public function restaurant() {
      return $this->belongsTo('App\Models\Restaurant', 'rest_id');
  }
}
