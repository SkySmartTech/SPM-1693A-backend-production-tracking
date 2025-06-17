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
        Schema::create('day_plans', function (Blueprint $table) {
            $table->id();

            $table->string('lineNo')->nullable();
            $table->string('respEmployee')->nullable();
            $table->string('buyer')->nullable();
            $table->string('style')->nullable();
            $table->string('gg')->nullable();
            $table->double('smv', 8, 2)->nullable();
            $table->integer('displayWH')->nullable();
            $table->string('actualWH')->nullable();
            $table->double('planTgtPcs', 8, 2)->nullable();
            $table->double('perHourPcs', 8, 2)->nullable();
            $table->integer('availableCader')->nullable();
            $table->integer('presentLinkers')->nullable();
            $table->string('checkPoint')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_plans');
    }
};
