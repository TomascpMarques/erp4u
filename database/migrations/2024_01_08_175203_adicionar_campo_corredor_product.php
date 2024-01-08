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
        Schema::table('Product', function (Blueprint $table) {
            $table->renameColumn('parteleira' , 'prateleira');
            $table->integer("corredor");
            $table->double('quantidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Product', function (Blueprint $table) {
        $table->dropColumn("corredor");
        $table->dropColumn('quantidade');
        $table->renameColumn('prateleira' , 'parteleira');
        });
    }
};
