<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    CONST ORDER_PENDING = "Pending";
    CONST ORDER_ACCEPTED = "Accepted";

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function schedule() {
        return $this->belongsTo('App\Models\Schedule');
    }

    public function foodOrder() {
        return $this->hasMany('App\Models\FoodOrder');
    }
}
