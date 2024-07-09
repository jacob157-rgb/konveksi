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
        Schema::create('jahit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("barang_id");
            $table->unsignedBigInteger("karyawan_id");
            $table->integer("jumlah_ambil");
            $table->integer("jumlah_kembali");
            $table->enum("satuan", ['kg', 'koli']);
            $table->double("ongkos", 15, 2);
            $table->dateTime("tanggal_ambil");
            $table->dateTime("tanggal_kembali");
            $table->enum("status", ['proses', 'jadi']);
            $table->timestamps();

            $table->foreign("barang_id")->references("id")->on("barang")->onDelete("cascade");
            $table->foreign("karyawan_id")->references("id")->on("karyawan")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jahit');
    }
};
