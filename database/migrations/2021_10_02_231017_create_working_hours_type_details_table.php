<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingHoursTypeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('working_hours_type_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('working_hours_type_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->char('shift', 1);
            $table->integer('duration');
            $table->integer('order_sequence');
            $table->integer('total_minutes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_hours_type_details');
    }
}
