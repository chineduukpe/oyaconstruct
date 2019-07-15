<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cartid')->nullable();
            $table->unsignedBigInteger('productid')->nullable();
            $table->unsignedBigInteger('userid')->nullable();
            $table->unsignedBigInteger('colourid')->nullable();
            $table->unsignedBigInteger('sizeid')->nullable();
            $table->unsignedBigInteger('storeid')->nullable();
            $table->unsignedBigInteger('categoryid')->nullable();
            $table->float('cost')->nullable();
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
        Schema::dropIfExists('cartproducts');
    }
}
