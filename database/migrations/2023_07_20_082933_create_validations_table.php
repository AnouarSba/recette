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
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->length(2);
            $table->float('money', 10,2)->default(0);
            $table->integer('tc', 4)->default(0);
            $table->integer('tsc', 4)->default(0);
            $table->float('flexy', 8,2)->default(0);
         //   $table->time('time');
            $table->date('c_date');
            $table->text('rq');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};