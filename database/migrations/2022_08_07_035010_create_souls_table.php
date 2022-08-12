<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souls', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_church_id')->constrained()->cascadeOnDelete();
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();
            
            $table->foreignId('soul_winner_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fellowship_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('designation_id')->constrained()->cascadeOnDelete();
            
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('location');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('souls');
    }
};
