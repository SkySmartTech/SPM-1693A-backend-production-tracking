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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('styleNo')->nullable();
            $table->integer('operation')->nullable();
            $table->string('sequenceNo')->nullable();
            $table->decimal('smv', 8, 2)->nullable();
            $table->enum('status', ['good', 'bad'])->default('good')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
