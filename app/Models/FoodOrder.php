<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
  public function food() {
      return $this->belongsTo('App\Models\Food');
  }

  public function order() {
    return $this->belongsTo('App\Models\Order');
  }
}
