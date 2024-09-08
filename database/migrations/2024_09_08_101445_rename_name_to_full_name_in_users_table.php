<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `users` CHANGE `name` `full_name` VARCHAR(255)');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `users` CHANGE `full_name` `name` VARCHAR(255)');
        });
    }
};
