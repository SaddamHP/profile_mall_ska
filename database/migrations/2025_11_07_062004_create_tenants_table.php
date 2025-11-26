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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id('id_tenant');
            $table->foreignId('id_category')->constrained('categories', 'id_category')->cascadeOnDelete();
            $table->foreignId('id_floor')->constrained('floors', 'id_floor')->cascadeOnDelete();
            $table->string('nama_tenant');
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
