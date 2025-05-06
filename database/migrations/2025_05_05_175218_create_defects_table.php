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
            //$table->foreignId('style_no')->constrained(table: 'style_settings');
            //$table->foreignId('operation')->constrained(table: 'operations');
            $table->integer('code_no')->nullable();
            $table->string('defect_code')->nullable();
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
