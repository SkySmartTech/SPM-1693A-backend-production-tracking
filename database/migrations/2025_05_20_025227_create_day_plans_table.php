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

            $table->string('line_no')->nullable();
            $table->string('resp_employee')->nullable();
            $table->string('buyer')->nullable();
            $table->string('style')->nullable();
            $table->string('gg')->nullable();
            $table->double('smv', 8, 2)->nullable();
            $table->integer('display_wh')->nullable();
            $table->string('actual_wh')->nullable();
            $table->double('plan_tgt_pcs', 8, 2)->nullable();
            $table->double('per_hour_pcs', 8, 2)->nullable();
            $table->integer('available_cader')->nullable();
            $table->integer('present_linkers')->nullable();
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
