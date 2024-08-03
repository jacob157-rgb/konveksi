<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('bon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('cutting_ambil');
            $table->decimal('nominal', 15,2);
            $table->enum('status', ['lunas', 'belumlunas']);
            $table->timestamps();
            $table->foreign('cutting_ambil')->references('id')->on('cutting_ambil')->onDelete('cascade');
            $table->foreign('id_karyawan')->references('id')->on('karyawan')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuttingambil');
    }
};
