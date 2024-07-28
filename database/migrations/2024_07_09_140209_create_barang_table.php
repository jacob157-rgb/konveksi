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
            $table->unsignedBigInteger('kain_id');
            $table->integer('jumlah_mentah');
            $table->enum('satuan', ['kg', 'koli', 'yard']);
            $table->double('harga', 15, 2);
            $table->dateTime('tanggal_datang');
            $table->timestamps();

            $table->foreign('supplyer_id')->references('id')->on('supplyer')->onDelete('cascade');
            $table->foreign('kain_id')->references('id')->on('kain')->onDelete('cascade');
        });

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
        Schema::dropIfExists('barang_jadi');
    }
};
