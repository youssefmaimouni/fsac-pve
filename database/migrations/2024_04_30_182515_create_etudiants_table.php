<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->integer('codeApogee');
            $table->primary('codeApogee');
            $table->string('nom_etudiant',20);
            $table->string('prenom_etudiant',20);
            $table->string('CNE',20);
            $table->string('photo',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
