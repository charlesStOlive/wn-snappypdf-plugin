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
        Schema::table('waka_snappypdf_pdfs', function (Blueprint $table) {
            $table->integer('layout_id')->unsigned()->nullable();
            $table->boolean('is_synced')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('waka_snappypdf_pdfs', function (Blueprint $table) {
            $table->dropColumn('layout_id');
            $table->dropColumn('is_synced');
        });
    }
};
