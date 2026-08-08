<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['job', 'service']);
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('price')->nullable();
            $table->string('contact');
            $table->enum('status', ['pending', 'approved', 'hidden'])->default('pending');
            $table->unsignedInteger('reports')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};