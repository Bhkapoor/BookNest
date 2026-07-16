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
 Schema::create('pyqs', function (Blueprint $table) {
    $table->id();

    $table->foreignId('uploaded_by')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->string('subject_name');
    $table->string('subject_code')->nullable();
    $table->string('course');
    $table->integer('semester');
    $table->year('year');

    $table->enum('exam_type', ['mid', 'end', 'internal']);

    $table->string('file_path');

    $table->enum('verification_status', ['unverified', 'verified'])
          ->default('unverified');

    $table->unsignedInteger('download_count')->default(0);

    $table->timestamps();

    $table->index(['subject_name', 'course', 'semester', 'year', 'exam_type']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pyqs');
    }
};
