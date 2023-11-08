<?php

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waka_snappypdf_pdfs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->mediumText('html')->nullable();
            $table->string('map_key')->nullable();
            $table->string('output_name')->nullable();
            $table->json('config')->nullable();
            //reorder
            $table->integer('sort_order')->default(0);
            //softDelete
            $table->softDeletes();
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
        Schema::dropIfExists('waka_snappypdf_pdfs');
    }
};
