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
        Schema::create('barang_mentah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplyer_id');
            $table->dateTime('tanggal_datang');
            $table->timestamps();
            $table->foreign('supplyer_id')->references('id')->on('supplyer')->onDelete('cascade');
        });

        Schema::create('kain_barang_mentah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_mentah_id');
            $table->string('kain');
            $table->timestamps();
            $table->foreign('barang_mentah_id')->references('id')->on('barang_mentah')->onDelete('cascade');
        });

        Schema::create('warna_kain', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kain_mentah_id');
            $table->string('warna');
            $table->string('jumlah');
            $table->string('harga');
            $table->enum('satuan', ['yard', 'kg']);
            $table->string('total');
            $table->timestamps();
            $table->foreign('kain_mentah_id')->references('id')->on('kain_barang_mentah')->onDelete('cascade');
        });

        //barang jadi

        Schema::create('barang_jadi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplyer_id');
            $table->dateTime('tanggal_kirim');
            $table->timestamps();
            $table->foreign('supplyer_id')->references('id')->on('supplyer')->onDelete('cascade');
        });

        Schema::create('model_barang_jadi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_jadi_id');
            $table->string('model');
            $table->timestamps();
            $table->foreign('barang_jadi_id')->references('id')->on('barang_jadi')->onDelete('cascade');
        });

        Schema::create('warna_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_barang_jadi_id');
            $table->string('warna');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('total');
            $table->timestamps();
            $table->foreign('model_barang_jadi_id')->references('id')->on('model_barang_jadi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_mentah');
        Schema::dropIfExists('kain_barang_mentah');
        Schema::dropIfExists('warna_kain_mentah');
        Schema::dropIfExists('barang_jadi');
        Schema::dropIfExists('model_barang_jadi');
        Schema::dropIfExists('warna_model');
    }
};
