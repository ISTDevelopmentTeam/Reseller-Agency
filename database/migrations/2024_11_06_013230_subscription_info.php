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
        Schema::create('subscription_information', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_title'); 
            $table->string('price')->unique();
            $table->string('line_1_detail');
            $table->string('line_2_detail');
            $table->string('line_3_detail');
            $table->string('line_4_detail');
            $table->string('line_5_detail');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_information');

    }
};
