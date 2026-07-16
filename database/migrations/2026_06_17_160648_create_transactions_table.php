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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('request_id')->constrained('book_requests')->cascadeOnDelete();
        $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();

        $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();

        $table->enum('transaction_type', ['buy', 'exchange']);

        $table->decimal('agreed_price', 8, 2)->nullable();

        $table->text('exchange_book_details')->nullable();

        $table->boolean('buyer_confirmed')->default(false);
        $table->boolean('seller_confirmed')->default(false);

        $table->enum('status', ['ongoing', 'completed', 'cancelled'])
              ->default('ongoing');

        $table->timestamp('completed_at')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
