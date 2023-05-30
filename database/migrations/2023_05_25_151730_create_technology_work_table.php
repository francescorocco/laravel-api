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
        Schema::create('technology_work', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
// queste 2 voci sopra sono inutili per tanto le eliminiamo  

// qui creiamo la tabella ponte in questo caso nella onDelete mettiamo cascade 
// dal momento in cui se viene eliminato un elemento della tabella i suoi relativi collegamenti
// non sono più necessari e di conseguenza viene rimosso anche l'elemento dalla tabella
            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id')->references('id')->on('works')->onDelete('CASCADE');

            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technology_work');
    }
};
