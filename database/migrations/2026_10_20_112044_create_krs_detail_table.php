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
    Schema::create('krs_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('krs_id')->constrained('krs')->onDelete('cascade');
        $table->foreignId('matakuliah_id')->constrained('matakuliahs')->onDelete('cascade');
        $table->timestamps();
    });
}