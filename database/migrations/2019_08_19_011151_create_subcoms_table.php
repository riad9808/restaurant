<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('num_commande');
            $table->foreign('num_commande')->references('id')->on('commandes')->onDelete('cascade');
            $table->bigInteger('prod');
            $table->foreign('prod')->references('id')->on('produits');
            $table->integer('qte');
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
        Schema::dropIfExists('subcoms');
    }
}
