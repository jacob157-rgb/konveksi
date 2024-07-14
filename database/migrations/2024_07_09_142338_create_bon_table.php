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
        Schema::create('bon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->unsignedBigInteger('cutting_id')->nullable();
            $table->unsignedBigInteger('jahit_id')->nullable();
            $table->double("nominal", 15, 2);
            $table->enum("status", ['belumlunas', 'lunas']);
            $table->timestamps();

            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->foreign('cutting_id')->references('id')->on('cutting')->onDelete('cascade');
            $table->foreign('jahit_id')->references('id')->on('jahit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon');
    }
};
