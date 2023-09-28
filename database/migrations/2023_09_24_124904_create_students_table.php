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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->boolean('is_attend')->default(false);
            $table->boolean('change_group')->default(false);
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_id')->constrained('guardians')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
