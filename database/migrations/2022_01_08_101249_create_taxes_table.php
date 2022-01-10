<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('tx_destination');
            $table->string('tx_vehicle_num');
            $table->string('tx_status');
            $table->string('tx_num_of_days');
            $table->date('tx_issue_date');
            $table->string('tx_amount');
            $table->string('tx_tax');
            $table->foreignId('checked_rooms_id');
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
        Schema::dropIfExists('taxes');
    }
}
