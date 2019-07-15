<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userid')->nullable();
            $table->string('invoice')->nullable();
            $table->string('paymenttype')->nullable();
            $table->string('paymentstatus')->nullable();
            $table->string('paymentdate')->nullable();
            $table->string('invoiccedate')->nullable();
            $table->double('totalamount')->nullable();
            $table->string('cartstatus')->nullable();
            $table->string('deliverstatus')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
