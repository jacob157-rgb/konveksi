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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("supplyer_id");
            $table->unsignedBigInteger("kain_id");
            $table->unsignedBigInteger("model_id");
            $table->unsignedBigInteger("warna_id");
            $table->integer("jumlah_mentah");
            $table->integer("jumlah_cutting");
            $table->integer("jumlah_jahit");
            $table->enum("satuan", ['kg', 'koli']);
            $table->double("harga", 15, 2);
            $table->dateTime("tanggal_datang");
            $table->dateTime("tanggal_jadi")->nullable();
            $table->timestamps();

            $table->foreign("supplyer_id")->references("id")->on("supplyer")->onDelete("cascade");
            $table->foreign("kain_id")->references("id")->on("kain")->onDelete("cascade");
            $table->foreign("model_id")->references("id")->on("model")->onDelete("cascade");
            $table->foreign("warna_id")->references("id")->on("warna")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
