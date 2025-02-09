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
        Schema::table('classses', function (Blueprint $table) {
            $table->time('from_time')->nullable()->change();
            $table->time('to')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classses', function (Blueprint $table) {
            $table->unsignedInteger('from_time')->change();
            $table->unsignedInteger('to')->change();
        });
    }
};
