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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->comment('Adres başlığı (Ev, İş, vs.)');
            $table->string('full_name');
            $table->string('phone');
            $table->string('city');
            $table->string('district');
            $table->string('neighborhood')->nullable();
            $table->text('address_line');
            $table->string('postal_code')->nullable();
            $table->enum('type', ['billing', 'shipping', 'both'])->default('both');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};