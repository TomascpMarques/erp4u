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
        Schema::create('monotorizacao', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->boolean('ativa');
            $table->string('sujeito');
            $table->string('tema');
            $table->string('conteudo');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('monotorizacao');
    }
};
