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
        Schema::create('password_policy', function (Blueprint $table) {
            $table->id();
            $table->string('policy_Name');
            $table->integer('policy_Valu')->nullable();
            $table->boolean('policy_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_policy');
    }
};
