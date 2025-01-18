<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nisns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->unique();
            $table->string('nisn', 20)->unique();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('persones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nisns');
    }
};
