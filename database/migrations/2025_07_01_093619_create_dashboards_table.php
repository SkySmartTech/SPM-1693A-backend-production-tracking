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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->timestamp('serverDateTime');
            $table->string('lineNo')->nullable();
            $table->string('buyer')->nullable();
            $table->double('todayTarget', 8, 2)->nullable();
            $table->double('todayTargetAchieve', 8, 2)->nullable();
            $table->double('todayBalance', 8, 2)->nullable();
            $table->double('uptoNowTarget', 8, 2)->nullable();
            $table->double('uptoNowTargetAchieve', 8, 2)->nullable();
            $table->double('uptoNowBalance', 8, 2)->nullable();
            $table->double('hourlyTarget', 8, 2)->nullable();
            $table->double('hourlyTargetAchieve', 8, 2)->nullable();
            $table->double('hourlyBalance', 8, 2)->nullable();
            $table->double('totalCheckQuantity', 8, 2)->nullable();
            $table->double('totalDefects', 8, 2)->nullable();
            $table->double('DHU', 8, 2)->nullable();
            $table->string('topDefectCode')->nullable();
            $table->double('performanceEFI', 8, 2)->nullable();
            $table->double('lineEFI', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
};
