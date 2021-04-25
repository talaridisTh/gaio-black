<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationSales extends Migration {

    public function up()
    {
        Schema::create('information_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('storage_id')->references('id')->on('storages');
            $table->foreignId('information_id')->references('id')->on('information');
            $table->integer("offer");
            $table->integer("total");
            $table->integer("quantity");
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('information_sales');
    }

}