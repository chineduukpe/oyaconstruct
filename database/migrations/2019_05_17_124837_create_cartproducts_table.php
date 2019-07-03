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
            $table->string('cartid')->nullable();
            $table->string('productid')->nullable();
            $table->string('userid')->nullable();
            $table->string('storeid')->nullable();
            $table->string('categoryid')->nullable();
            $table->string('cost')->nullable();
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
