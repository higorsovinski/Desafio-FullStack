<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNiveisTable extends Migration
{
    public function up()
    {
        Schema::create('niveis', function (Blueprint $table) {
            $table->id();
            $table->string('nivel');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('niveis');
    }
}
