<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class FoodOrder extends Model
{
  use SoftDeletes;

  public function food() {
      return $this->belongsTo('App\Models\Food');
  }

  public function order() {
    return $this->belongsTo('App\Models\Order');
  }
}
