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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // matches model + Filament form
            $table->string('location')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('lat_long')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('number_of_seats')->nullable();
            $table->unsignedBigInteger('organizer_id');
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('organizer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
