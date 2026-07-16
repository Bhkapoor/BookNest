<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone')->after('email');

            $table->string('course')->after('phone');

            $table->integer('semester')->after('course');

            $table->string('registration_id')
                  ->unique()
                  ->after('semester');

            $table->enum('role', ['user', 'admin'])
                  ->default('user')
                  ->after('registration_id');

            $table->enum('account_status', ['active', 'suspended', 'blocked'])
                  ->default('active')
                  ->after('role');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'course',
                'semester',
                'role',
                'account_status'
            ]);

        });
    }
};
