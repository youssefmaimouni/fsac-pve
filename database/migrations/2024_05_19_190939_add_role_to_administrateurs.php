<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->string('role')->default('user');  
        });
    }

    public function down()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
