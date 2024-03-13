<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesenvolvedoresTable extends Migration
{
    public function up()
    {
        Schema::create('desenvolvedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id')->constrained('niveis')->onDelete('cascade');
            $table->string('nome');
            $table->char('sexo', 1);
            $table->date('datanascimento');
            $table->string('hobby');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('desenvolvedores');
    }
}
