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
        Schema::create('recettes', function (Blueprint $table) {
                $table->increments('id');

            $table->integer('user_id')->length(2);
            $table->integer('emp_id')->length(2);
            $table->integer('bus_id')->length(2);
            $table->integer('type')->length(2);
            $table->float('rotation', 2,1)->nullable()->default(0);
            $table->integer('ligne_id')->length(2);
            $table->integer('brigade')->length(1);
            $table->float('flexy', 8,2)->default(0);
            $table->float('dettes', 8,2)->default(0);
            $table->integer('recette')->length(5);
            
            $table->integer('t20')->length(3)->default(0);
            $table->integer('t25')->length(3)->default(0);
            $table->integer('t30')->length(3)->default(0);
            $table->integer('s20')->length(3)->default(0);
            $table->integer('s25')->length(3)->default(0);
            $table->integer('s30')->length(3)->default(0);
            $table->text('r20')->length(25)->nullable();
            $table->text('r25')->length(25)->nullable();
            $table->text('r30')->length(25)->nullable();
            $table->date('b_date');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recettes');
    }
};