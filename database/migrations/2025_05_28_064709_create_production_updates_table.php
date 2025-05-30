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
            $table->timestamp('server_date_time');
            $table->string('line_no')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('buyer')->nullable();
            $table->string('gg')->nullable();
            $table->double('smv', 8, 2)->nullable();
            $table->double('present_carder', 8, 2)->nullable();
            $table->string('style')->nullable();
            $table->string('color')->nullable();
            $table->string('size_name')->nullable();
            $table->string('check_point')->nullable();
            $table->enum('quality_state', ['Success','Rework', 'Defect'])->default('Success')->nullable();
            $table->string('part')->nullable();
            $table->string('location')->nullable();
            $table->string('defect_code')->nullable();
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
