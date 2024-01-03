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
    public function up()
    {
        Schema::table("PostalCode", function (Blueprint $table) {
            $table->renameColumn("PostalCode", "postalCode");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("PostalCode", function (Blueprint $table) {
            $table->renameColumn("postalCode", "PostalCode");
        });
    }
};
