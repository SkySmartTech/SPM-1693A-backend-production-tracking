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
        Schema::create('defects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('styleNo')->nullable();
            $table->bigInteger('operation')->nullable();
            $table->integer('codeNo')->nullable();
            $table->string('defectCode')->nullable();
            $table->enum('status', ['good', 'bad'])->default('good')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defects');
    }
};
