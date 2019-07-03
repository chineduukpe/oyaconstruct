<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ownername');
            $table->string('ownerphone');
            $table->string('owneraddress');
            $table->string('owneremail')->nullable();
            $table->string('password');
            $table->string('username');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('idcard')->nullable();
            $table->string('idcardno')->nullable();
            $table->string('idcardtype')->nullable();
            $table->string('approvedby')->nullable();
            $table->string('dateapproved')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
