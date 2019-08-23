<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->integer('num_table');
            $table->string('serveur');

            $table->enum('valide',['nonvalide','valide','prete','paye','annuler'])->default('nonvalide');

           // $table->boolean('paye')->default(false);
            $table->float('prix')->nullable();



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
        Schema::dropIfExists('commandes');
    }
}
