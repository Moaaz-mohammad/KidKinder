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
        Schema::create('classses', function (Blueprint $table) {
            $table->id();
            $table->string('class_content_name');
            $table->integer('class_number');
            $table->unsignedInteger('from_age');
            $table->unsignedInteger('to_age');
            $table->integer('total_seats');
            $table->double('tution_fee');
            $table->unsignedInteger('from_time');
            $table->unsignedInteger('to');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classses');
    }
};
