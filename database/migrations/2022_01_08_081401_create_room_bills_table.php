<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_bills', function (Blueprint $table) {
            $table->id();
            $table->date('rb_issue_date');
            $table->string('rb_doller_rate');
            $table->string('rb_amount_doller');
            $table->string('rb_cost');
            $table->string('rb_status')->default('pending');
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
        Schema::dropIfExists('room_bills');
    }
}
