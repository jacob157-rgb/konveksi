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
        Schema::create('jahit_ambil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->dateTime('tanggal_ambil');
            $table->timestamps();
            $table->foreign('id_karyawan')->references('id')->on('karyawan')->onDelete('cascade');
        });

        Schema::create('jahit_ambil_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jahit_ambil');
            $table->string('model');
            $table->timestamps();
            $table->foreign('id_jahit_ambil')->references('id')->on('jahit_ambil')->onDelete('cascade');
        });

        Schema::create('jahit_warna_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ambil_model');
            $table->string('warna');
            $table->integer('jumlah_ambil');
            $table->enum('satuan_ambil', ['pcs'])->default('pcs');
            $table->double('ongkos', 15, 2);
            $table->timestamps();
            $table->foreign('id_ambil_model')->references('id')->on('jahit_ambil_model')->onDelete('cascade');
        });

        Schema::create('jahit_kembali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jahit_warna_model');
            $table->integer('jumlah_kembali')->nullable();
            $table->enum('satuan_kembali', ['pcs'])->default('pcs');
            $table->double('total_ongkos', 15, 2)->nullable();
            $table->dateTime('tanggal_kembali')->nullable();
            $table->timestamps();
            $table->foreign('id_jahit_warna_model')->references('id')->on('jahit_warna_model')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jahit_kembali');
        Schema::dropIfExists('jahit_warna_model');
        Schema::dropIfExists('jahit_ambil_model');
        Schema::dropIfExists('jahit_ambil');
    }
};
