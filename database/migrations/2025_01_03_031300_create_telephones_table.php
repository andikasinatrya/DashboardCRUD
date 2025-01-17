<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('telephones', function (Blueprint $table) {
            $table->id();
            $table->string('telephone_number', 13)->unique();
            $table->foreignId('person_id')->constrained('persones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telephones');
    }
};
