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
    Schema::create('book_requests', function (Blueprint $table) {
        $table->id();

        $table->foreignId('book_id')
            ->constrained('books')
            ->cascadeOnDelete();

        $table->foreignId('buyer_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('seller_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->enum('request_type', ['buy', 'exchange']);

        $table->text('message')->nullable();

        $table->text('offered_book_details')->nullable();

        $table->enum('status', [
            'pending',
            'accepted',
            'rejected',
            'cancelled',
            'auto_rejected',
            'completed'
        ])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_requests');
    }
};
