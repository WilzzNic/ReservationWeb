<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');

            // Uncomment this if using Table Numbering Function
            $table->integer('rest_id');
            
            $table->integer('table_id')->nullable();
            $table->integer('schedule_id');
            $table->integer('table_demand');
            $table->string('status');
            $table->date('reservation_date');
            // $table->string('complaint')->nullable();
            // $table->string('reason_rejected')->nullable();
            $table->dateTime('date_ordered');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
