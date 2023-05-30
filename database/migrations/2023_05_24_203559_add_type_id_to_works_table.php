<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

                // qui creiamo il collegamento tra le 2 tabelle, la disposizione del 
                // codice deve essere questa perchè segue una logica
            $table->foreign('type_id')->references('id')->on('types')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropForeign('works_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};
