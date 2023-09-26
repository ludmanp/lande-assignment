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
        Schema::create('loan_euribors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained();
            $table->unsignedTinyInteger('segment_nr');
            $table->unsignedSmallInteger('rate_in_basis_points');
            $table->timestamps();
            $table->unique(['loan_id','segment_nr']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_euribors');
    }
};
