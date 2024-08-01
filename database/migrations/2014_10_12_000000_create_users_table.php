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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', length:60);
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob')->nullable();
            $table->boolean('gender')->nullable();
            $table->enum('identity_type', ['ktp', 'passport', 'npwp'])->nullable();
            $table->string('identity_number', length:60)->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('phone', length:20)->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
