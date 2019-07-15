<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_id');
            $table->string('payment_type');
            $table->double('payment_amount');
            $table->double('payment_total_commision');
            $table->integer('confirmation_code');
            $table->unsignedBigInteger('delivered_by')->nullable();
            $table->integer('payment_reference')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_phone')->nullable();
            $table->string('paid_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
