<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Adverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
           
            $table->increments('id');

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->text('description')->nullable();
            $table->string('image',500)->nullable();
            $table->date('start_date',50)->nullable();
            $table->date('final_date',50)->nullable();
            $table->integer('qtd_view')->default(0);
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
        Schema::dropIfExists('adverts');
    }
}
