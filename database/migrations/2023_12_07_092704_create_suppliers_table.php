<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Supplier', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('code')->unique();
            $table->string('name');
            $table->string('address1');
            $table->string('address2');
            $table->string('town')->nullable();
            $table->string('postalCode');
            $table->tinyInteger('status')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('Supplier');
    }
};
