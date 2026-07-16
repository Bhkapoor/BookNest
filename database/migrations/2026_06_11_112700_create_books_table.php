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
    Schema::create('books', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('title');
        $table->string('author');
        $table->string('subject');
        $table->string('subject_code')->nullable();

        $table->string('course');
        $table->unsignedTinyInteger('semester');

        $table->enum('condition', [
            'Like New',
            'Good',
            'Acceptable',
            'Poor'
        ]);

        $table->enum('listing_type', [
            'sell',
            'exchange',
            'both'
        ])->default('sell');

        $table->decimal('price', 8, 2)->nullable();

        $table->string('photo')->nullable();

        $table->text('description')->nullable();

        $table->enum('status', [
            'available',
            'reserved',
            'sold',
            'exchanged'
        ])->default('available');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
