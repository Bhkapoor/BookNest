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
    Schema::create('meetups', function (Blueprint $table) {
        $table->id();

        $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnDelete();

        $table->foreignId('proposed_by')->constrained('users')->cascadeOnDelete();

        $table->string('location');
        $table->string('custom_location')->nullable();

        $table->date('meetup_date');
        $table->time('meetup_time');

        $table->text('notes')->nullable();

        $table->enum('status', ['proposed', 'confirmed', 'cancelled'])
              ->default('proposed');

        $table->timestamp('confirmed_at')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetups');
    }
};
