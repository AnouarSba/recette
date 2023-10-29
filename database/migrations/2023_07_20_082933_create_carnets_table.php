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
        Schema::create('carnets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status')->length(2)->default(0);
            $table->integer('type')->length(2);
            $table->integer('begin')->nullable()->default(1);
            $table->integer('end')->nullable()->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnets');
    }
};