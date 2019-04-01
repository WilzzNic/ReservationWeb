<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    CONST ORDER_PENDING = "Pending";
    CONST ORDER_ACCEPTED = "Accepted";
    CONST ORDER_COMPLETED = "Completed";

    const CREATED_AT = 'date_ordered';
    // const UPDATED_AT = 'updated_at';

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function schedule() {
        return $this->belongsTo('App\Models\Schedule', 'schedule_id', 'id');
    }

    public function table() {
        return $this->belongsTo('App\Models\Table');
    }

    public function foodOrder() {
        return $this->hasMany('App\Models\FoodOrder');
    }

    public function foods() {
        return $this->belongsToMany('App\Models\Food', 'food_orders')->withPivot('amount');
    }

    public function history() {
        return $this->hasOne('App\Models\History', 'order_id');
    }

    public function restaurant() {
        return $this->belongsTo('App\Models\Restaurant', 'rest_id');
    }
}
