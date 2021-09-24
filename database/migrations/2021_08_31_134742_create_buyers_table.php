<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('buyers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id');
            $table->bigInteger('province_id');
            $table->bigInteger('city_id');
            $table->bigInteger('departement_id');
            $table->bigInteger('rank_id');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->string('company');
            $table->text('description')->nullable();
            $table->string('remark');
            $table->text('address');
            $table->char('status', 1);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyers');
    }
}
