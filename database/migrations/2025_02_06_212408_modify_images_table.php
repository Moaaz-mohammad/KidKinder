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
        Schema::table('images', function (Blueprint $table) {
            $table->removeColumn(['imageable_id', 'imageable_type']);

            $table->morphs('imageable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
        //  // Revert back to the old columns if we rollback the migration
        $table->unsignedBigInteger('imageable_id');
        $table->string('imageable_type');
        });
    }
};
