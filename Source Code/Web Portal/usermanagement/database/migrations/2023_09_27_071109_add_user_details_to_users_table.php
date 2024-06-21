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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_number');
            $table->string('user_address');
            $table->string('gender');
            $table->boolean('is_supervisor');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('modile_number');
            $table->dropColumn('user_address');
            $table->dropColumn('gender');
            $table->dropColumn('is_supervisor');
            $table->dropColumn('status');
        });
    }
};
