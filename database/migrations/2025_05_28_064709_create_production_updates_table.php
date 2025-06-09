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
        Schema::create('production_updates', function (Blueprint $table) {
            $table->id();
            $table->timestamp('serverDateTime');
            $table->string('lineNo')->nullable();
            $table->string('QRCode')->nullable();
            $table->string('buyer')->nullable();
            $table->string('gg')->nullable();
            $table->double('smv', 8, 2)->nullable();
            $table->double('presentCarder', 8, 2)->nullable();
            $table->string('style')->nullable();
            $table->string('color')->nullable();
            $table->string('sizeName')->nullable();
            $table->string('checkPoint')->nullable();
            $table->enum('qualityState', ['Success','Rework', 'Defect'])->default('Success')->nullable();
            $table->string('part')->nullable();
            $table->string('location')->nullable();
            $table->string('defectCode')->nullable();
            $table->integer('state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_updates');
    }
};
