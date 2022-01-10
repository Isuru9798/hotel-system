<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersWithTableQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_with_table_qrs', function (Blueprint $table) {
            $table->id();
            $table->string('owq_table');
            $table->string('owq_quantity');
            $table->string('owq_service_chrge');
            $table->foreignId('items_id');
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
        Schema::dropIfExists('orders_with_table_qrs');
    }
}
