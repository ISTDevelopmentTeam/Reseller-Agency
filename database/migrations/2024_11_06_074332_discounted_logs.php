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
        Schema::create('discounted_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_membership'); 
            $table->string('plan_type');
            $table->string('amount');
            $table->string('date_added');
            $table->string('date_start');
            $table->string('date_ended');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounted_logs');

    }
};
