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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('cutting_ambil')->nullable();
            $table->unsignedBigInteger('jahit_ambil')->nullable();
            $table->unsignedBigInteger('cutting_kembali')->nullable();
            $table->unsignedBigInteger('jahit_kembali')->nullable();
            $table->decimal('nominal', 15,2);
            $table->decimal('nominal_terbayarkan', 15,2);
            $table->enum('status', ['lunas','terbayarkan', 'belum terbayarkan'])->default('belum terbayarkan');
            $table->timestamps();
            $table->foreign('cutting_ambil')->references('id')->on('cutting_ambil')->onDelete('cascade');
            $table->foreign('jahit_ambil')->references('id')->on('jahit_ambil')->onDelete('cascade');
            $table->foreign('cutting_kembali')->references('id')->on('cutting_kembali')->onDelete('cascade');
            $table->foreign('jahit_kembali')->references('id')->on('jahit_kembali')->onDelete('cascade');
            $table->foreign('id_karyawan')->references('id')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
