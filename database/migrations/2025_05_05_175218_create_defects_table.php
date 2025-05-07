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
            $table->bigInteger('style_no')->nullable();
            $table->bigInteger('operation')->nullable();
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
