<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('email')->unique(); // Unique email
            $table->string('password'); // Password
            $table->string('name'); // Name
            $table->json('data')->nullable(); // Data stored as JSON (optional in your diagram)
            $table->timestamps(); // created_at and updated_at
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
