<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function tables() {
        return $this->hasMany('App\Models\Table', 'rest_id');
    }

    // public function getAvailableTables() {
    //     $tables = $this->hasMany('App\Models\Table', 'rest_id')->select("id", "total_table", "total_reserved");

    //     foreach($table) {

    //     }

    //     $total_available = $total_table - $total_reserved;

    //     return $total_available;
    // }

    public function schedules() {
        return $this->hasMany('App\Models\Schedule', 'rest_id');
    }

    public function foods() {
        return $this->hasMany('App\Models\Food', 'rest_id');
    }

    // Uncomment this if using Table Numbering Function
    public function orders() {
        return $this->hasMany('App\Models\Order', 'rest_id');
    }
}
